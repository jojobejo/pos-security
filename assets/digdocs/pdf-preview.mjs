import { AnnotationMode, GlobalWorkerOptions, getDocument } from './pdfjs/pdf.min.mjs';

const assets = new URL('./pdfjs/', import.meta.url);
GlobalWorkerOptions.workerSrc = new URL('pdf.worker.min.mjs', assets).href;

export async function showPdf(panel, bytes, signal) {
    const canvas = panel.querySelector('canvas');
    const status = panel.querySelector('.archive-preview-status');
    const navigation = panel.querySelector('.archive-pdf-pages');
    const label = panel.querySelector('.archive-pdf-page');
    const previous = navigation.querySelector('[data-page-step="-1"]');
    const next = navigation.querySelector('[data-page-step="1"]');
    // Render only pixels. The viewer does not create links, forms or a scripting sandbox.
    const task = getDocument({
        data: bytes,
        cMapUrl: new URL('cmaps/', assets).href,
        standardFontDataUrl: new URL('standard_fonts/', assets).href,
        iccUrl: new URL('iccs/', assets).href,
        wasmUrl: new URL('wasm/', assets).href,
        enableXfa: false,
        maxImageSize: 16777216
    });
    let destruction;
    const destroy = () => {
        destruction = destruction || task.destroy().catch(() => {});
        return destruction;
    };
    signal.addEventListener('abort', destroy, { once: true });
    let pageNumber = 1;

    try {
        const pdf = await task.promise;
        const render = async function (number) {
            previous.disabled = true;
            next.disabled = true;
            const page = await pdf.getPage(number);
            const natural = page.getViewport({ scale: 1 });
            const scale = Math.min(1.6, 1800 / Math.max(natural.width, natural.height));
            const viewport = page.getViewport({ scale: scale });

            canvas.width = Math.ceil(viewport.width);
            canvas.height = Math.ceil(viewport.height);
            await page.render({ canvas: canvas, viewport: viewport, annotationMode: AnnotationMode.DISABLE }).promise;
            page.cleanup();

            if (signal.aborted) {
                return;
            }
            canvas.hidden = false;
            status.hidden = true;
            navigation.hidden = pdf.numPages < 2;
            label.textContent = 'Halaman ' + number + ' dari ' + pdf.numPages;
            pageNumber = number;
            previous.disabled = number <= 1;
            next.disabled = number >= pdf.numPages;
        };

        const turnPage = async function (step) {
            try {
                await render(pageNumber + step);
            } catch {
                canvas.hidden = true;
                navigation.hidden = true;
                status.textContent = 'Halaman tidak dapat ditampilkan. Gunakan Unduh lampiran.';
                status.hidden = false;
                await destroy();
            }
        };
        await render(1);
        previous.addEventListener('click', () => turnPage(-1));
        next.addEventListener('click', () => turnPage(1));
    } catch (error) {
        await destroy();
        throw error;
    }
}
