@extends('layouts.admin')

@section('content')
<div class="content-wrapper" style="padding-top:40px;">
    <div class="container-fluid">
        <div class="card-body">

            <div class="mb-4">

    <div class="mb-5">

    <span class="badge hero-badge mb-3">
        Dynamic Form Creator
    </span>

    <h1 class="display-5 fw-bold">
        Build Beautiful Forms
    </h1>

    <p class="text-muted fs-5">
        Design custom forms with drag & drop.
        Configure fields, preview instantly and export JSON schema.
    </p>

</div>

    <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">

        <label class="fw-semibold mb-2">
            Form Title
        </label>

        <input
            type="text"
            id="formTitle"
            maxlength="200"
            class="form-control form-control-lg"
            placeholder="Enter Form Title">

    </div>
</div>

    <div class="d-flex justify-content-between mt-2">
        <small class="text-muted">
            Submission URL
        </small>

        <small class="text-muted">
            <span id="titleCount">0</span>/200
        </small>
    </div>

</div>

<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link active" href="#">
            Form Editor
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            Settings
        </a>
    </li>
</ul>

<div class="row">
                <div class="col-md-8">
                    <div id="dropCanvas" class="border border-dashed rounded p-4 bg-light" style="min-height: 400px;">
                        <div id="emptyState" class="text-center text-muted mt-5">
                            <div class="py-5">

    <div style="font-size:60px;">
        🧩
    </div>

    <h4 class="fw-bold mt-3">
        Your Form Is Empty
    </h4>

    <p class="text-muted">
        Drag fields from the right panel to start creating your form.
    </p>

</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card builder-panel">
                        <div class="card-body">

                            <ul class="nav nav-pills mb-3">
                                <li class="nav-item">
                                    <button id="addFieldsTab" class="nav-link active" type="button">🧩 Add Fields</button>
                                </li>
                                <li class="nav-item">
                                    <button id="fieldOptionsTab" class="nav-link" type="button">⚙️ Field Options</button>
                                </li>
                            </ul>

                            <div id="addFieldsPanel" class="row g-2">
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="text">Text Input</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="textarea">Text Area</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="number">Number Input</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="email">Email Input</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="phone">Phone Input</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="dropdown">Dropdown</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="radio">Radio Buttons</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="checkbox">Checkboxes</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="date">Date Picker</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="file">File Upload</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="title">Title</div></div>

                                <div class="col-6"><div class="field-tile" draggable="true" data-type="description">Description</div></div>

                                <div class="col-6"><div class="field-tile" draggable="true" data-type="newline">New Line</div></div>

                                <div class="col-6"><div class="field-tile" draggable="true" data-type="pagebreak">Page Break</div></div>

                                <div class="col-6"><div class="field-tile" draggable="true" data-type="hidden">Hidden Field</div></div>

                                <div class="col-6"><div class="field-tile" draggable="true" data-type="state">State</div></div>

                                <div class="col-6"><div class="field-tile" draggable="true" data-type="city">City</div></div>

                                <div class="col-6"><div class="field-tile" draggable="true" data-type="statecity">State & City</div></div>
                            </div>

                            <div id="fieldOptionsPanel" class="d-none">
                                <h6>Field Options</h6>

                                <label class="form-label">Label</label>
                                <input type="text" id="optionLabel" class="form-control mb-3">

                                <label class="form-label">Placeholder</label>
                                <input type="text" id="optionPlaceholder" class="form-control mb-3">

                                <label class="form-label">CSS Class</label>
                                <input type="text" id="optionClass" class="form-control mb-3">

                                <div class="form-check mb-3">
                                    <input type="checkbox" id="optionRequired" class="form-check-input">
                                    <label class="form-check-label" for="optionRequired">Required</label>
                                </div>

                                <button class="btn btn-danger w-100" onclick="deleteField(selectedFieldId)">
                                    Remove Element
                                </button>
                            </div>
							<div id="textConfigWrapper">
								<label class="form-label">Min Characters</label>
								<input type="number" id="optionMin" class="form-control mb-3">

								<label class="form-label">Max Characters</label>
								<input type="number" id="optionMax" class="form-control mb-3">

								<label class="form-label">Default Value</label>
								<input type="text" id="optionDefault" class="form-control mb-3">
							</div>
							<div id="optionsWrapper" class="d-none mb-3">
								<label class="form-label">Options</label>

								<div id="optionsList"></div>

								<button type="button"
										class="btn btn-sm btn-outline-primary mt-2"
										onclick="addOption()">
									+ Add Option
								</button>
							</div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button class="btn btn-outline-secondary" id="cancelBtn">Cancel</button>
                <button class="btn btn-primary" id="nextBtn">Next</button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="jsonModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Form JSON Schema</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <pre id="jsonOutput"
                     style="max-height:500px;overflow:auto;background:#f8f9fa;padding:15px;border-radius:5px;">
                </pre>
            </div>

        </div>
    </div>
</div>
</div>
<style>
    body{
    font-family:'Inter',sans-serif;
}
    .field-tile{

    background:white;

    border:1px solid #e2e8f0;

    border-radius:18px;

    padding:18px;

    text-align:center;

    font-size:14px;

    font-weight:700;

    transition:.3s;

    cursor:grab;
}

.field-tile:hover{

    transform:
    translateY(-5px)
    scale(1.02);

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    );

    color:white;

    border-color:transparent;
}

.hero-badge{
    background:linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    ) !important;

    padding:10px 16px;

    border-radius:999px;

    font-weight:600;
}


.form-control{
    border-radius:14px;
    border:1px solid #dbe2ea;
    padding:12px 16px;
}


.form-control:focus{
    border-color:#2563eb !important;

    box-shadow:
    0 0 0 4px rgba(
        37,
        99,
        235,
        .15
    ) !important;
}

.field-card{

    background:rgba(
        255,
        255,
        255,
        .85
    );

    backdrop-filter:blur(18px);

    border-radius:24px;

    border:1px solid rgba(
        255,
        255,
        255,
        .3
    );

    box-shadow:
    0 20px 40px rgba(
        15,
        23,
        42,
        .08
    );

    transition:.3s;
}

.field-card:hover{
    transform:translateY(-2px);
}

.builder-panel{
    border:none;
    border-radius:24px;
    background:white;
    box-shadow:
    0 20px 40px rgba(15,23,42,.08);
}

.premium-input{
    width:100%;
    border:none;

    background:
    linear-gradient(
        145deg,
        #ffffff,
        #f8fafc
    );

    padding:16px 18px;

    border-radius:16px;

    font-size:15px;

    box-shadow:
    inset 0 1px 2px rgba(255,255,255,.8),
    0 6px 18px rgba(15,23,42,.05);

    transition:.3s;
}

.premium-input:hover{
    transform:translateY(-1px);
}

.premium-textarea{
    width:100%;

    min-height:120px;

    resize:none;

    border:none;

    border-radius:16px;

    padding:18px;

    background:
    linear-gradient(
        145deg,
        #ffffff,
        #f8fafc
    );

    box-shadow:
    inset 0 1px 2px rgba(255,255,255,.8),
    0 6px 18px rgba(15,23,42,.05);

    transition:.3s;
}

#dropCanvas{
    background:white;
    border:none;

    border-radius:24px;

    min-height:650px;

    padding:30px;

    box-shadow:
    0 20px 40px rgba(
        15,
        23,
        42,
        .08
    );
}
#dropCanvas.drag-over{
    border-color:#2563eb;
    background:#eff6ff;
}

.card{
    border:none!important;
    border-radius:16px!important;
}

.btn-primary{
    border:none;

    border-radius:12px;

    padding:12px 30px;

    font-weight:600;

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    );
}

.btn-outline-secondary{
    border-radius:10px;
}

.content-wrapper{
    background:linear-gradient(
        135deg,
        #f8fafc,
        #eef2ff
    );
    min-height:100vh;
    padding:40px;
}

.field-card{
    background:white;

    border-radius:22px;

    border:none;

    box-shadow:
    0 10px 30px rgba(
        0,
        0,
        0,
        .06
    );

    transition:.3s;
}

.field-card:hover{
    transform:translateY(-4px);
}

#dropCanvas{
    background:white;
    border:2px dashed #cbd5e1;
    border-radius:18px;
    min-height:600px;
    padding:30px;
}

#dropCanvas.drag-over{
    border-color:#2563eb;
    background:#eff6ff;
}

#nextBtn{
    padding:10px 30px;
    font-weight:600;
}

#cancelBtn{
    padding:10px 30px;
}

.field-tile{
    background:white;
    border:1px solid #e2e8f0;
    border-radius:12px;
    padding:14px;
    cursor:grab;
    transition:.25s;
    font-weight:600;
}

.field-tile:hover{
    transform:translateY(-5px);

    border-color:#2563eb;

    box-shadow:
    0 15px 35px rgba(
        37,
        99,
        235,
        .18
    );
}

.nav-tabs .nav-link.active{
    font-weight:700;
}

.btn-primary{
    border-radius:10px;
}

.btn-outline-secondary{
    border-radius:10px;
}
.field-badge{
    display:inline-flex;

    align-items:center;

    background:#eef2ff;

    color:#4338ca;

    padding:8px 14px;

    border-radius:999px;

    font-size:11px;

    font-weight:700;

    letter-spacing:.8px;
}

.field-title{
    font-size:18px;
    font-weight:700;
    color:#111827;
}

.field-preview{
    margin-top:15px;
}

.action-btn{
    border:none;

    background:#eff6ff;

    color:#2563eb;

    width:40px;
    height:40px;

    border-radius:12px;

    transition:.25s;
}

.action-btn:hover{
    background:#2563eb;
    color:white;
}

.delete-btn:hover{
    background:#ef4444!important;
}

.gap-2{
    gap:8px;
}
</style>

<script>
    let draggedFieldType = null;
    let formFields =
JSON.parse(localStorage.getItem('formFields')) || [];
    let selectedFieldId = null;
    function saveToLocalStorage() {
    localStorage.setItem(
        'formFields',
        JSON.stringify(formFields)
    );
}

    const fieldLabels = {
    text: '▣ Text Input',
    textarea: '▤ Text Area',
    number: '◫ Number Input',
    email: '✉ Email Input',
    phone: '⌕ Phone Input',
    dropdown: '▾ Dropdown',
    radio: '◉ Radio Buttons',
    checkbox: '☑ Checkboxes',
    date: '◷ Date Picker',
    file: '⬆ File Upload',
    title: '◆ Title',
    description: '☰ Description',
    newline: '↵ New Line',
    pagebreak: '━ Page Break',
    hidden: '◌ Hidden Field',
    state: '⌖ State',
    city: '⌂ City',
    statecity: '⌘ State & City'
};
    document.getElementById('formTitle').addEventListener('input', function () {

    const count = this.value.length;
    const counter = document.getElementById('titleCount');

    counter.innerText = count;

    if(count < 100){
        counter.style.color = '#10b981';
    }
    else if(count < 180){
        counter.style.color = '#f59e0b';
    }
    else{
        counter.style.color = '#ef4444';
    }

});

    document.querySelectorAll('.field-tile').forEach(tile => {
        tile.addEventListener('dragstart', function () {
            draggedFieldType = this.dataset.type;
        });
    });

    const dropCanvas = document.getElementById('dropCanvas');

    dropCanvas.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropCanvas.classList.add('drag-over');
    });

    dropCanvas.addEventListener('dragleave', function () {
        dropCanvas.classList.remove('drag-over');
    });

    dropCanvas.addEventListener('drop', function (e) {
        e.preventDefault();

        if (!draggedFieldType) return;

        const newField = {
            id: Date.now(),
            type: draggedFieldType,
            label: fieldLabels[draggedFieldType],
            placeholder: '',
            cssClass: '',
            required: false,
            options: ['Option 1', 'Option 2'],
            min: '',
            max: '',
            defaultValue: '',
        };

        formFields.push(newField);
        renderFields();
    });

    function renderOptionsList(field) {
        const optionsList = document.getElementById('optionsList');
        optionsList.innerHTML = '';

        field.options.forEach((option, index) => {
            optionsList.innerHTML += `
                <div class="input-group mb-2">
                    <input type="text"
                        class="form-control"
                        value="${option}"
                        oninput="updateOption(${index}, this.value)">

                    <button type="button"
                            class="btn btn-outline-danger"
                            onclick="removeOption(${index})">
                        ×
                    </button>
                </div>`;
        });
    }

    function updateOption(index, value) {
        const field = formFields.find(item => item.id === selectedFieldId);
        if (!field) return;

        field.options[index] = value;
        renderFields();
    }

    function addOption() {
        const field = formFields.find(item => item.id === selectedFieldId);
        if (!field) return;

        field.options.push('New Option');
        renderOptionsList(field);
        renderFields();
    }

    function removeOption(index) {
        const field = formFields.find(item => item.id === selectedFieldId);
        if (!field) return;

        field.options.splice(index, 1);
        renderOptionsList(field);
        renderFields();
    }

    function renderFields() {
        saveToLocalStorage();
        dropCanvas.innerHTML = '';

        if (formFields.length === 0) {
            dropCanvas.innerHTML = `
                <div id="emptyState" class="text-center text-muted mt-5">
                    <div style="font-size:60px;">
                        🧩
                    </div>
                    <h4 class="fw-bold mt-3">
                        Your Form Is Empty
                    </h4>
                    <p class="text-muted">
                        Drag fields from the right panel to start creating your form.
                    </p>
                </div>`;
            return;
        }

        formFields.forEach(field => {
            const card = document.createElement('div');
card.className = 'field-card p-4 mb-4';

card.innerHTML = `
    <div class="d-flex justify-content-between align-items-start mb-3">

        <div>
            <div class="field-badge mb-2">
                ${field.type.toUpperCase()}
            </div>

            <h5 class="field-title mb-1">
                ${field.label}
                ${field.required ? '<span class="text-danger">*</span>' : ''}
            </h5>

            <small class="text-muted">
                ${field.placeholder || 'Placeholder not configured'}
            </small>
        </div>

        <div class="d-flex gap-2">

            <button 
                type="button"
                class="action-btn"
                onclick="moveUp(${field.id})"
                title="Move Up">
                ↑
            </button>

            <button 
                type="button"
                class="action-btn"
                onclick="moveDown(${field.id})"
                title="Move Down">
                ↓
            </button>

            <button 
                type="button"
                class="action-btn"
                onclick="editField(${field.id})"
                title="Edit">
                ✏️
            </button>

            <button 
                type="button"
                class="action-btn"
                onclick="duplicateField(${field.id})"
                title="Duplicate">
                ⧉
            </button>

            <button 
                type="button"
                class="action-btn delete-btn"
                onclick="deleteField(${field.id})"
                title="Delete">
                🗑
            </button>

        </div>
    </div>

    <div class="field-preview">
        ${getFieldPreview(field)}
    </div>
`;

            dropCanvas.appendChild(card);
        });
    }

    function getFieldPreview(field) {
        if (field.type === 'textarea') {

    return `
        <textarea
            class="premium-textarea ${field.cssClass}"
            placeholder="${field.placeholder || 'Write something amazing...'}"
            disabled>
        </textarea>
    `;
}

    if (field.type === 'dropdown') {
        return `
            <select class="form-control ${field.cssClass}" disabled>
                ${field.options.map(option => `<option>${option}</option>`).join('')}
            </select>
        `;
    }

    if (field.type === 'radio') {
        return `
            <div class="${field.cssClass}">
                ${field.options.map(option => `
                    <label class="me-3">
                        <input type="radio" disabled> ${option}
                    </label>
                `).join('')}
            </div>
        `;
    }

    if (field.type === 'checkbox') {
        return `
            <div class="${field.cssClass}">
                ${field.options.map(option => `
                    <label class="me-3">
                        <input type="checkbox" disabled> ${option}
                    </label>
                `).join('')}
            </div>
        `;
    }

    if (field.type === 'date') {
        return `<input type="date" class="form-control ${field.cssClass}" disabled>`;
    }

    if (field.type === 'file') {
        return `<input type="file" class="form-control ${field.cssClass}" disabled>`;
    }
    if (field.type === 'title') {
        return `<h3>${field.label}</h3>`;
    }

    if (field.type === 'description') {
        return `<p>${field.defaultValue || 'Description Text'}</p>`;
    }

    if (field.type === 'newline') {
        return `<br>`;
    }

    if (field.type === 'pagebreak') {
        return `<hr style="border-top:2px dashed #999;">`;
    }

    if (field.type === 'hidden') {
        return `
            <input type="text"
                class="form-control"
                value="${field.defaultValue || ''}"
                disabled>
        `;
    }

    if (field.type === 'state') {
        return `
            <select class="form-control" disabled>
                <option>Gujarat</option>
                <option>Maharashtra</option>
            </select>
        `;
    }

    if (field.type === 'city') {
        return `
            <select class="form-control" disabled>
                <option>Ahmedabad</option>
                <option>Rajkot</option>
            </select>
        `;
    }

    if (field.type === 'statecity') {
        return `
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" disabled>
                        <option>State</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-control" disabled>
                        <option>City</option>
                    </select>
                </div>
            </div>
        `;
    }

        return `
    <div class="premium-input-wrapper">

        <input
            type="${field.type}"
            class="premium-input ${field.cssClass}"
            placeholder="${field.placeholder || 'Type something...'}"
            disabled>

    </div>
`;
    }

    function editField(id) {
        selectedFieldId = id;

        const field = formFields.find(item => item.id === id);
        const isOptionField = ['dropdown', 'radio', 'checkbox'].includes(field.type);
        if (!field) return;

        document.getElementById('addFieldsPanel').classList.add('d-none');
        document.getElementById('fieldOptionsPanel').classList.remove('d-none');

        document.getElementById('addFieldsTab').classList.remove('active');
        document.getElementById('fieldOptionsTab').classList.add('active');

        document.getElementById('optionLabel').value = field.label;
        document.getElementById('optionPlaceholder').value = field.placeholder || '';
        document.getElementById('optionClass').value = field.cssClass || '';
        document.getElementById('optionRequired').checked = field.required || false;
        document.getElementById('optionsWrapper').classList.toggle('d-none', !isOptionField);

        if (isOptionField) {
            renderOptionsList(field);
        }
        document.getElementById('optionMin').value = field.min || '';
        document.getElementById('optionMax').value = field.max || '';
        document.getElementById('optionDefault').value = field.defaultValue || '';
    }

    function duplicateField(id) {
        const index = formFields.findIndex(field => field.id === id);
        if (index === -1) return;

        const copiedField = {
            ...formFields[index],
            id: Date.now()
        };

        formFields.splice(index + 1, 0, copiedField);
        renderFields();
    }

    function deleteField(id) {
        formFields = formFields.filter(field => field.id !== id);

        if (selectedFieldId === id) {
            selectedFieldId = null;
            showAddFieldsPanel();
        }

        renderFields();
    }

    function updateSelectedField() {
        const field = formFields.find(item => item.id === selectedFieldId);
        if (!field) return;

        field.label = document.getElementById('optionLabel').value;
        field.placeholder = document.getElementById('optionPlaceholder').value;
        field.cssClass = document.getElementById('optionClass').value;
        field.required = document.getElementById('optionRequired').checked;
        field.min = document.getElementById('optionMin').value;
        field.max = document.getElementById('optionMax').value;
        field.defaultValue = document.getElementById('optionDefault').value;

        renderFields();
    }

    document.getElementById('optionLabel').addEventListener('input', updateSelectedField);
    document.getElementById('optionPlaceholder').addEventListener('input', updateSelectedField);
    document.getElementById('optionClass').addEventListener('input', updateSelectedField);
    document.getElementById('optionRequired').addEventListener('change', updateSelectedField);

    document.getElementById('addFieldsTab').addEventListener('click', showAddFieldsPanel);
    document.getElementById('optionMin').addEventListener('input', updateSelectedField);
    document.getElementById('optionMax').addEventListener('input', updateSelectedField);
    document.getElementById('optionDefault').addEventListener('input', updateSelectedField);

    function showAddFieldsPanel() {
        document.getElementById('addFieldsPanel').classList.remove('d-none');
        document.getElementById('fieldOptionsPanel').classList.add('d-none');

        document.getElementById('addFieldsTab').classList.add('active');
        document.getElementById('fieldOptionsTab').classList.remove('active');
    }

    document.getElementById('nextBtn').addEventListener('click', function () {

        const formSchema = {
            title: document.getElementById('formTitle').value,
            fields: formFields
        };

        document.getElementById('jsonOutput').textContent =
            JSON.stringify(formSchema, null, 2);

        const modal = new bootstrap.Modal(
            document.getElementById('jsonModal')
        );

        modal.show();
    });

    document.getElementById('cancelBtn').addEventListener('click', function () {
        if (confirm('Are you sure you want to clear the form?')) {
            formFields = [];
            selectedFieldId = null;

            document.getElementById('formTitle').value = '';
            document.getElementById('titleCount').innerText = '0';

            showAddFieldsPanel();
            renderFields();
        }
    });

    function moveUp(id) {
        const index = formFields.findIndex(f => f.id === id);

        if (index <= 0) return;

        [formFields[index], formFields[index - 1]] =
        [formFields[index - 1], formFields[index]];

        renderFields();
    }

    function moveDown(id) {
        const index = formFields.findIndex(f => f.id === id);

        if (index === -1 || index === formFields.length - 1) return;

        [formFields[index], formFields[index + 1]] =
        [formFields[index + 1], formFields[index]];

        renderFields();
        showAddFieldsPanel();
    }
    renderFields();
</script>
@endsection