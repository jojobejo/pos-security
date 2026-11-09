const trigger = document.getElementById('archive-preview');
const dialog = document.getElementById('archive-preview-dialog');
const content = document.getElementById('archive-preview-content');
const template = document.getElementById('archive-preview-template');
let request;

if (typeof dialog.showModal === 'function') {
    trigger.hidden = false;
    trigger.addEventListener('click', openPreview);
    document.getElementById('archive-preview-close').addEventListener('click', () => dialog.close());
    dialog.addEventListener('close', () => {
        request.abort();
        content.replaceChildren();
        document.body.classList.remove('archive-preview-open');
        trigger.focus();
    });
}

async function openPreview() {
    if (dialog.open) {
        return;
    }

    request = new AbortController();
    const { signal } = request;
    content.replaceChildren(template.content.cloneNode(true));
    content.scrollTop = 0;
    dialog.showModal();
    document.body.classList.add('archive-preview-open');

    const status = content.querySelector('.archive-preview-status');
    const data = content.querySelector('.archive-preview-data');
    const kind = trigger.dataset.kind;

    try {
        const response = await fetch(trigger.dataset.src, {
            signal, mode: 'same-origin', redirect: 'error', cache: 'no-store'
        });
        if (!response.ok) {
            throw new Error('Preview request failed');
        }
        const mime = (response.headers.get('Content-Type') || '').split(';')[0];
        if (kind === 'pdf' && mime === 'application/pdf') {
            const [renderer, bytes] = await Promise.all([import('./pdf-preview.mjs'), response.arrayBuffer()]);
            if (!signal.aborted) {
                await renderer.showPdf(content, new Uint8Array(bytes), signal);
            }
            return;
        }

        if (kind === 'image' && ['image/jpeg', 'image/png', 'image/webp'].includes(mime)) {
            const image = element('img', 'archive-preview-image');
            const blob = await response.blob();
            if (signal.aborted) {
                return;
            }
            const url = URL.createObjectURL(blob);
            image.alt = 'Pratinjau gambar';
            image.src = url;
            try {
                await image.decode();
            } finally {
                URL.revokeObjectURL(url);
            }
            if (!signal.aborted) {
                data.append(image);
            }
        } else if (mime === 'application/json') {
            const preview = await response.json();
            if (preview.kind !== kind) {
                throw new Error('Unexpected preview format');
            }
            if (!signal.aborted) {
                renderOffice(data, preview);
            }
        } else {
            throw new Error('Unexpected preview format');
        }
        status.hidden = true;
    } catch {
        if (!signal.aborted) {
            status.textContent = 'Pratinjau tidak tersedia. Gunakan Unduh lampiran.';
            status.hidden = false;
        }
    }
}

function renderOffice(container, preview) {
    if (preview.limited) {
        container.append(element('p', 'alert alert-warning', 'Sebagian isi ditampilkan. Unduh lampiran untuk melihat dokumen lengkap.'));
    }
    if (preview.kind === 'text') {
        container.append(textBlock(preview.text));
        return;
    }
    if (!preview.pages.length) {
        container.append(element('p', 'text-muted', 'Tidak ada halaman yang dapat ditampilkan.'));
        return;
    }

    const select = element('select', 'form-control form-control-sm');
    const field = element('label', 'archive-preview-select', preview.kind === 'sheets' ? 'Lembar kerja' : 'Slide');
    const page = element('div');
    preview.pages.forEach((entry, index) => {
        const option = element('option', '', entry.name || String(index + 1));
        option.value = String(index);
        select.append(option);
    });
    field.append(select);
    container.append(field, page);

    const renderPage = () => {
        const selected = preview.pages[Number(select.value)];
        if (selected.unavailable) {
            page.replaceChildren(element('p', 'text-muted', 'Bagian ini tidak dapat ditampilkan. Unduh lampiran untuk melihat isinya.'));
        } else if (preview.kind === 'sheets') {
            page.replaceChildren(sheetTable(selected));
        } else {
            page.replaceChildren(slideContent(selected));
        }
    };

    select.addEventListener('change', renderPage);
    renderPage();
}

function sheetTable(sheet) {
    if (!sheet.rows.length) {
        return element('p', 'text-muted', 'Lembar ini tidak memiliki sel yang dapat ditampilkan.');
    }

    const wrapper = element('div', 'archive-sheet-scroll');
    const table = element('table', 'table table-bordered table-sm archive-sheet mb-0');
    const heading = table.createTHead().insertRow();
    heading.append(element('th', '', '#'));
    for (let column = 1; column <= sheet.columns; column++) {
        const header = element('th', '', String.fromCharCode(64 + column));
        header.scope = 'col';
        heading.append(header);
    }
    const body = table.createTBody();
    for (const row of sheet.rows) {
        const line = body.insertRow();
        const index = element('th', '', row.number);
        index.scope = 'row';
        line.append(index);
        for (let column = 1; column <= sheet.columns; column++) {
            line.insertCell().textContent = row.cells[column] ?? '';
        }
    }
    wrapper.append(table);
    return wrapper;
}

function slideContent(slide) {
    const result = element('article', 'archive-slide');
    result.append(element('h3', 'h6 mb-3', slide.name));
    if (slide.text || !slide.images.length) {
        result.append(textBlock(slide.text));
    }
    for (const file of slide.images) {
        if (['image/jpeg', 'image/png', 'image/webp'].includes(file.mime)) {
            const image = element('img', 'archive-slide-image');
            image.alt = 'Gambar pada ' + slide.name;
            image.src = 'data:' + file.mime + ';base64,' + file.base64;
            result.append(image);
        }
    }
    return result;
}

function textBlock(text) {
    return text ? element('pre', 'archive-text', text) : element('p', 'text-muted', 'Tidak ada teks yang dapat ditampilkan.');
}

function element(tag, className = '', text) {
    const node = document.createElement(tag);
    node.className = className;
    if (text !== undefined) {
        node.textContent = text;
    }
    return node;
}
