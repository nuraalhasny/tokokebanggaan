const successAndError = ['success', 'error'];

const qSelect = (el) => document.querySelector(el);
const qSelectAll = (el) => document.querySelectorAll(el);
const qSelectName = (el) => document.querySelector(`[name='${el}']`);

const GetApi = (url) => {
    return fetch(url).then(res => res.json());
}

const PostApi = async (url, dataJson) => {
    ShowLoader();
    const data = await fetch(url, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            "X-CSRF-TOKEN": qSelectName('_token').value,
            'Content-type': 'application/json; charset=UTF-8',
        },
        body: dataJson
    })
    .then((response) => response.json())
    .then((json) => {
        let icon = json.status;
        if (!successAndError.includes(icon)) icon = 'info';
        
        Swal.fire(
            capitalizeFirstLetter(json.status),
            json.message,
            icon
        ).then(() => {
            window.location.reload();
        });
    }).catch(error => {
        let icon = error.status;
        if (!successAndError.includes(icon)) icon = 'info';

        Swal.fire(
            error.status,
            error.message,
            icon
        );
    });

    HideLoader();
    return data;
}

const GetClientTypeahead = () => {
    const url = `${base_api}/cms/typeahead/client/${token}`;
    return GetApi(url, token);
}

const GetProductTypeahead = () => {
    const url = `${base_api}/cms/typeahead/product/${token}`;
    return GetApi(url);
}

const ShowLoader = () => {
    let loader = qSelect('.loader');
    let bg = qSelect('.bg-black');

    loader.style.display = "block";
    bg.style.display = "block";
}

const HideLoader = () => {
    let loader = qSelect('.loader');
    let bg = qSelect('.bg-black');

    loader.style.display = "none";
    bg.style.display = "none";
}

const setInputNull = (node) => {
    qSelect(node).value = '';
}

const setInputValue = (node, val) => {
    qSelect(node).value = val;
}

const setInputValueThenDisabled = (node, val) => {
    setInputValue(node, val);
    qSelect(node).disabled = true;
}

const setInputValueThenEnabled = (node, val) => {
    setInputValue(node, val);
    qSelect(node).disabled = false;
}

const getInputValue = (node) => {
    if (qSelect(node)) {
        return qSelect(node).value;
    }
}

const convertDateIndonesian = (tgl) => {
    let date = new Date(tgl);
    let tahun = date.getFullYear();
    let bulan = date.getMonth();
    let tanggal = date.getDate();
    let hari = date.getDay();
    let jam = date.getHours();
    let menit = date.getMinutes();
    let detik = date.getSeconds();
    
    switch(hari) {
        case 0: hari = "Minggu"; break;
        case 1: hari = "Senin"; break;
        case 2: hari = "Selasa"; break;
        case 3: hari = "Rabu"; break;
        case 4: hari = "Kamis"; break;
        case 5: hari = "Jum'at"; break;
        case 6: hari = "Sabtu"; break;
    }

    switch(bulan) {
        case 0: bulan = "Januari"; break;
        case 1: bulan = "Februari"; break;
        case 2: bulan = "Maret"; break;
        case 3: bulan = "April"; break;
        case 4: bulan = "Mei"; break;
        case 5: bulan = "Juni"; break;
        case 6: bulan = "Juli"; break;
        case 7: bulan = "Agustus"; break;
        case 8: bulan = "September"; break;
        case 9: bulan = "Oktober"; break;
        case 10: bulan = "November"; break;
        case 11: bulan = "Desember"; break;
    }

    let tampilTanggal = `${tanggal}, ${bulan} ${tahun}`;
    return tampilTanggal;
}

const convertDateRangeToIndonesian = (tanggal_uji, separator) => {
    if (tanggal_uji) {
        tanggal_uji = tanggal_uji.split(separator);
        tanggal_uji[0] = convertDateIndonesian(tanggal_uji[0]);
        tanggal_uji[1] = convertDateIndonesian(tanggal_uji[1]);
    
        return `${tanggal_uji[0]} - ${tanggal_uji[1]}`;
    } else {
        return null;
    }
}

const RenderYear = (element) => {
    let html = '';
    const years = dyears;
    const current_year = new Date().getFullYear();
    years.forEach(year => {
        html += `<option value="${year}" ${current_year == year ? 'selected' : ''}>${year}</option>`;
    });
    element.innerHTML = html;

    if (qSelect('#start_date') && qSelect('#end_date')) {
        qSelect('#start_date').remove();
        qSelect('#end_date').remove();
    }
}

const RenderSelectedYear = (element, selected_year) => {
    let html = '';
    const years = dyears;
    const current_year = new Date().getFullYear();
    years.forEach(year => {
        if (year == selected_year) {
            html += `<option value="${year}" ${current_year == year ? 'selected' : ''}>${year}</option>`;
        }
    });
    element.innerHTML = html;

    if (qSelect('#start_date') && qSelect('#end_date')) {
        qSelect('#start_date').remove();
        qSelect('#end_date').remove();
    }

    if (qSelect('#until_date')) {
        qSelect('#until_date').remove();
    }
}

const RenderMonth = (element, selected_semester) => {
    let html = '';
    const current_month = new Date().getMonth();
    const month_name = {
        '0': 'Januari',
        '1': 'Februari',
        '2': 'Maret',
        '3': 'April',
        '4': 'Mei',
        '5': 'Juni',
        '6': 'Juli',
        '7': 'Agustus',
        '8': 'September',
        '9': 'Oktober',
        '10': 'November',
        '11': 'Desember'
    };

    if (selected_semester == 'ganjil') {
        for (let index = 0; index < 6; index++) {
            html += `<option value="${index}" ${current_month == index ? 'selected' : ''}>${month_name[index]}</option>`;
        }
    } else {
        for (let index = 6; index < 12; index++) {
            html += `<option value="${index}" ${current_month == index ? 'selected' : ''}>${month_name[index]}</option>`;
        }
    }

    if (qSelect('#start_date') && qSelect('#end_date')) {
        qSelect('#start_date').remove();
        qSelect('#end_date').remove();
    }

    element.innerHTML = html;
}

const RenderRange = (element) => {
    const html = `<div class="row justify-content-between">
                      <input type="date" name="start_date" class="form-control form-control-solid col-6" id="start_date" autocomplete="off" onfocusout='CheckDateRange(this, this.value)'>
                      <input type="date" name="end_date" class="form-control form-control-solid col-6" id="end_date" autocomplete="off" onfocusout='CheckDateRange(this, this.value)'>
                  </div>`;

    if (qSelect(`#period_parent select[name='frekuensi']`)) {
        removeAllChildNodes(qSelect(`#period_parent select[name='frekuensi']`));
    }
    element.innerHTML += html;
}

const RenderUntil = (element) => {
    const html = `<div class="row justify-content-between">
                      <input type="date" name="until_date" class="form-control form-control-solid col-12" id="until_date" autocomplete="off" onfocusout="CheckUntil(this, this.value)">
                  </div>`;

    if (qSelect(`#period_parent select[name='frekuensi']`)) {
        removeAllChildNodes(qSelect(`#period_parent select[name='frekuensi']`));
    }
    element.innerHTML += html;
}

const RenderSemester = (element, selected_semester) => {
    let html;
    if (selected_semester == 'ganjil') {
        html = '<option value="ganjil">Ganjil</option>';
    } else {
        html = '<option value="genap">Genap</option>';
    }

    if (qSelect('#start_date') && qSelect('#end_date')) {
        qSelect('#start_date').remove();
        qSelect('#end_date').remove();
    }
    if (qSelect('#until_date')) {
        qSelect('#until_date').remove();
    }
    element.innerHTML = html;
}

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
    parent.style.display = 'none';
}

const SetInputValueToNull = (inputs) => {
    inputs.forEach(input => {
        input.value = '';
    });
}

const SetAutoNumericValue = (el, value) => {
    const element = AutoNumeric.getAutoNumericElement(el)
    value = replaceAll(value, '.', '');
    if (element) {
        element.set(value);
    } else {
        qSelect(el).value = value;
    }
}

function replaceAll(string, search, replace) {
    return string.split(search).join(replace);
}

const capitalizeFirstLetter = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

const alertSuccess = (message) => {
    Swal.fire(
        "Sukses",
        message,
        'success'
    );
}

const alertErrorValidation = (message) => {
    let html = ``;

    if (typeof(message) == 'array' || typeof(message) == 'object') {
        message.forEach((key, item) => {
            html += `${key}. ${item} </br>`
        });
    } else {
        html += message;
    }

    Swal.fire(
        "Bad Request",
        html,
        'info'
    );
}

const swalAlert = (message) => {
    Swal.fire(
        "Peringatan",
        message,
        'error'
    );
}

const onlyUnique = (value, index, array) => {
  return array.indexOf(value) === index;
}

const handleFileUpload = async (event, folder, label, elementId) => {
    const files = event.target.files;
    const formData = new FormData()
    const url = saveFileURL;

    formData.append('label', label)
    formData.append('file', files[0])
    formData.append('folder', folder)

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            "X-CSRF-TOKEN": qSelectName('_token').value
        },
        body: formData
    })
    .then((response) => response.json())
    .then((json) => {
        if (json.status == 'success') {
            Swal.fire(
                capitalizeFirstLetter(json.status),
                json.message,
                'success'
            );
            
            qSelect(elementId).value = json.data.id;
        }else if (!json.status) {
            alertErrorValidation(json.message);
        }else{
            let icon = json.status;
            if (!successAndError.includes(icon)) icon = 'info';

            Swal.fire(
                capitalizeFirstLetter(json.status),
                json.message,
                icon
            );
        }

        return json;
    }).catch(error => {
        let icon = error.status;
        if (!successAndError.includes(icon)) icon = 'info';

        Swal.fire(
            error.status,
            error.message,
            icon
        );
        
        return null;
    });

    return response;
}

const errorSwal = (message) => {
    Swal.fire(
        "Error",
        message,
        'error'
    );
}

const getInputValIfNullError = (node, field_name = null) => {
    let value = getInputValue(node);

    const element = qSelect(node);
    if (element.hasAttribute('type')) {
        if (element.getAttribute('type') == 'checkbox') {
            if (!qSelect(`${node}:checked`)) {
                value = null;
            }
        }
    }
    if (field_name === null) {
        field_name = replaceAll(node, "_", " ");
        field_name = replaceAll(field_name, "#", "");
        field_name = replaceAll(field_name, ".", "");
        field_name = capitalizeFirstLetter(field_name);
    }
    if (!value) {
        errorSwal(`${field_name} harus diisi!`);
        throw "fill the field correctly";
    }
    return value;
}

const getSelectValues = (node) => {
    return $(node).val();
}

const getSelectValsIfNullError = (node, field_name = null) => {
    const value = getSelectValues(node);
    if (field_name === null) {
        field_name = replaceAll(node, "_", " ");
        field_name = replaceAll(field_name, "#", "");
        field_name = replaceAll(field_name, ".", "");
        field_name = capitalizeFirstLetter(field_name);
    }
    if (!value[0]) {
        isErrorShowed = true;
        errorSwal(`${field_name} harus diisi!`);
    }
    return value;
}

const getMultipleSelectValsIfNullError = (node, field_name = null) => {
    const els = qSelectAll(node);
    let data = [];
    els.forEach(element => {
        const id = "#"+element.getAttribute('id');
        const vals = getSelectValsIfNullError(id, field_name);
        data.push(...vals);
    });

    return data;
}

const alertSuccessWithRedirect = (message, link) => {
    Swal.fire(
        "Sukses",
        message,
        'success'
    ).then(() => {
        window.location = link;
    });
}

const alertSuccessWithReload = (message) => {
    Swal.fire(
        "Sukses",
        message,
        'success'
    ).then(() => {
        window.location.reload();
    });
}

const alertSuccessWithRedirectBack = (message) => {
    Swal.fire(
        "Sukses",
        message,
        'success'
    ).then(() => {
        window.history.go(-1); 
        return false;
    });
}

const fetchDelete = async (url) => {
    ShowLoader();
    let response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": qSelectName('_token').value
                    }
                })
                .then(response => response.json())
                .catch(error => {
                    Swal.fire(
                        "Warning",
                        error,
                        "warning"
                    );
                });
        
    HideLoader();

    if (response.status == 'success') {
        alertSuccessWithReload(response.message);
    }else if (!response.status) {
        alertErrorValidation(response.message);
    }
}

const deleteWithConfirmation = (url) => {
    Swal.fire({
        icon: "error",
        title: "Konfirmasi",
        text: "Apakah Anda Yakin Ingin Menghapus Data Ini",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) fetchDelete(url);
    });
}

const confirmationAlert = (message) => {
    return Swal.fire({
        icon: "warning",
        title: "Konfirmasi",
        text: message,
        showCancelButton: true,
    }).then(result => {
        return result.isConfirmed;
    });
}

const fetchDeleteMod = async (url, direct) => {
    ShowLoader();
    let response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": qSelectName('_token').value
                    }
                })
                .then(response => response.json())
                .catch(error => {
                    Swal.fire(
                        "Warning",
                        error,
                        "warning"
                    );
                });
        
    HideLoader();

    if (response.status == 'success') {
        alertSuccessWithRedirect(response.message, direct);
    }else if (!response.status) {
        alertErrorValidation(response.message);
    }
}

const deleteWithConfirmationMod = (url, direct) => {
    Swal.fire({
        icon: "error",
        title: "Confirmation",
        text: "Apakah Anda Yakin Ingin Menghapus Data Ini",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            fetchDeleteMod(url, direct);
        }else{

        }
    });
}

const getValueInsideElement = (node) => {
    let data = {};
    const elements = qSelectAll(`${node} input, ${node} select, ${node} textarea`);
    elements.forEach(element => {
        let name = null;
        if (element.hasAttribute('name')) {
            name = element.getAttribute('name')
        } else if (element.hasAttribute('id')) {
            name = element.getAttribute('id')
        }

        if (name) {
            const value = element.value;
            if (name.includes('[]')) {
                name = name.replace('[]', '');
                if (!data[name]) {
                    data[name] = []
                }
                data[name].push(value);
            } else {
                let pass = false;
                if (element.hasAttribute('type')) {
                    if (element.getAttribute('type') == 'file') {
                        pass = true;
                    }
                }
                if (!pass) {
                    if (!data[name] && element.getAttribute('type') != 'checkbox' && element.getAttribute('type') != 'radio') data[name] = value;
                    if (element.tagName == 'TEXTAREA' && tinyMCE.activeEditor) {
                        if (!data[name]) {
                            data[name] = tinyMCE.activeEditor.getContent();
                        }
                        if (editor = tinymce.get(name)) {
                            const content = editor.getContent();
                            data[name] = content;
                        }
                    }
                    if (element.hasAttribute('type')) {
                        if (element.getAttribute('type') == 'radio') {
                            if (element.hasAttribute('name')) {
                                if (qSelect(`[name='${element.getAttribute('name')}']:checked`)) {
                                    data[name] = qSelect(`[name='${element.getAttribute('name')}']:checked`).value;
                                }
                            } else {
                                if (qSelect(`#${element.getAttribute('id')}:checked`)) {
                                    data[name] = qSelect(`#${element.getAttribute('id')}:checked`).value;
                                }
                            }
                        } else if (element.getAttribute('type') == 'checkbox') {
                            if (element.hasAttribute('name')) {
                                if (qSelect(`[name='${element.getAttribute('name')}']:checked`)) {
                                    data[name] = qSelect(`[name='${element.getAttribute('name')}']:checked`).value;
                                }
                            } else {
                                if (qSelect(`#${element.getAttribute('id')}:checked`)) {
                                    data[name] = qSelect(`#${element.getAttribute('id')}:checked`).value;
                                }
                            }
                        }
                    }
                }
            }
        }
    });

    return data;
}

const getValueInsideElementRequired = (node) => {
    
    let data = {};
    const elements = qSelectAll(`${node} input, ${node} select, ${node} textarea`);
    elements.forEach(element => {
        let name = null;
        if (element.hasAttribute('name')) {
            name = element.getAttribute('name')
        } else if (element.hasAttribute('id')) {
            name = element.getAttribute('id')
        }

        if (name) {
            const value = element.value;
            if (name.includes('[]')) {
                name = name.replace('[]', '');
                if (!data[name]) {
                    data[name] = []
                }
                data[name].push(value);
            } else {
                let pass = false;
                if (element.hasAttribute('type')) {
                    if (element.getAttribute('type') == 'file') {
                        pass = true;
                    }
                }
                if (!pass) {
                    if (!data[name] && element.getAttribute('type') != 'checkbox' && element.getAttribute('type') != 'radio') data[name] = value;
                    if (element.tagName == 'TEXTAREA' && tinyMCE.activeEditor) {
                        if (!data[name]) {
                            data[name] = tinyMCE.activeEditor.getContent();
                        }
                    }
                    if (element.hasAttribute('type')) {
                        if (element.getAttribute('type') == 'radio') {
                            if (element.hasAttribute('name')) {
                                if (qSelect(`[name='${element.getAttribute('name')}']:checked`)) {
                                    data[name] = qSelect(`[name='${element.getAttribute('name')}']:checked`).value;
                                }
                            } else {
                                if (qSelect(`#${element.getAttribute('id')}:checked`)) {
                                    data[name] = qSelect(`#${element.getAttribute('id')}:checked`).value;
                                }
                            }
                        } else if (element.getAttribute('type') == 'checkbox') {
                            if (element.hasAttribute('name')) {
                                if (qSelect(`[name='${element.getAttribute('name')}']:checked`)) {
                                    data[name] = qSelect(`[name='${element.getAttribute('name')}']:checked`).value;
                                }
                            } else {
                                if (qSelect(`#${element.getAttribute('id')}:checked`)) {
                                    data[name] = qSelect(`#${element.getAttribute('id')}:checked`).value;
                                }
                            }
                        }
                    }
                }
            }
        }
        if (name) {
            if (!data[name]) {
                errorSwal(`${name} harus diisi!`);
                throw "fill the field correctly";
            }
        }
    });

    return data;
    
}

const updateSingleField = (type, id, key, value, csrf_token = null) => {
    const icon = disabledEnabledIconFactory(value);
    value = !parseInt(value);
    const html = `<button style="height: 0px;border: none !important; background: transparent !important;" onclick="patchData('${type}', this, '${id}', '${key}', '${value}', '${csrf_token}')">${icon}</button>`

    return html;
}

const toYYMMDD = (date) => {
    const tanggal = new Date(date);
    const year = tanggal.toLocaleString("default", { year: "numeric" });
    const month = tanggal.toLocaleString("default", { month: "2-digit" });
    const day = tanggal.toLocaleString("default", { day: "2-digit" });

    return `${year}-${month}-${day}`;
}

const disabledEnabledIconFactory = (value) => {
    if (value == 'false' || !value) {
        icon = makeDisabledIcon();
    } else if (value) {
        icon = makeEnabledIcon();
    }
    return icon;
}

const makeEnabledIcon = () => {
    return `<i class="mdi mdi-toggle-switch" style="font-size:40px;color: #5660d9;"></i>`;
}

const makeDisabledIcon = () => {
    return `<i class="mdi mdi-toggle-switch-off" style="font-size:40px;color: #ff3366;"></i>`;
}

const patchData = async (type, el, id, key, value, csrf_token = null) => {
    ShowLoader()
    baseUrl = `${masterUrl}${type}/${id}`;
    value = value === 'true';
    const headers = {
        'Accept': 'application/json',
        'Content-type': 'application/json; charset=UTF-8',
    };
    
    if (csrf_token) headers["X-CSRF-TOKEN"] = csrf_token;

    const data = await fetch(baseUrl, {
        method: 'PATCH',
        body: `{"${key}": ${value}}`,
        headers
    })
    .then((response) => response.json())
    .then((json) => {
        if (json.status == 'success') {
            const icon = disabledEnabledIconFactory(value);
            const html = `<button style="height: 0px;border: none !important; background: transparent !important;" onclick="patchData('${type}', this, '${id}', '${key}', '${!value}')">${icon}</button>`
            el.parentNode.innerHTML = html;
        }else{
            let icon = json.status;
            if (!successAndError.includes(icon)) icon = 'info';

            Swal.fire(
                capitalizeFirstLetter(json.status),
                json.message,
                icon
            );
        }
    }).catch(error => {
        let icon = error.status;
        if (!successAndError.includes(icon)) icon = 'info';

        Swal.fire(
            error.status,
            error.message,
            icon
        );
    });

    HideLoader();

    return data;
}

const handleDeleteButton = (type, el, id) => {
    baseUrl = `${masterUrl}${type}/${id}`;
    Swal.fire({
        icon: 'warning',
        title: 'Do you want to delete data?',
        showCancelButton: true,
        confirmButtonText: 'Ok',
    }).then((result) => {
        if (result.isConfirmed) destroyData(type);
    })
}

const destroyData = async (type) => {
    ShowLoader();
    const data = await fetch(baseUrl, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then((response) => response.json())
    .then((json) => {
        let icon = json.status;
        if (!successAndError.includes(icon)) icon = 'info';

        if (json.status == 'success') $(`#tb_${type}`).DataTable().ajax.reload();;
        
        Swal.fire(
            capitalizeFirstLetter(json.status),
            json.message,
            icon
        );
    }).catch(error => {
        let icon = error.status;
        if (!successAndError.includes(icon)) icon = 'info';

        Swal.fire(
            error.status,
            error.message,
            icon
        );
    });

    HideLoader();
    return data;
}

const handleDeleteRow = (element) => {
    Swal.fire({
        icon: "warning",
        title: 'Apakah anda yakin ingin menghapus data ini?',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
    }).then((result) => {
        if (result.isConfirmed) element.parentNode.parentNode.remove();
    })
}

const deleteData = async (url) => {
    Swal.fire({
        title: 'Warning',
        text: 'Apakah Anda Yakin Ingin Menghapus Data ini ?',
        icon: 'warning',
        showCancelButton: true,
    }).then(async (result) => {
        if (result.isConfirmed) {
            ShowLoader();
            const data = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    "X-CSRF-TOKEN": qSelectName('_token').value
                },
            })
            .then((response) => response.json())
            .then((json) => {
                let icon = json.status;
                if (!successAndError.includes(icon)) icon = 'info';
                
                Swal.fire(
                    capitalizeFirstLetter(json.status),
                    json.message,
                    icon
                ).then(() => {
                    window.location.reload();
                });
            }).catch(error => {
                let icon = error.status;
                if (!successAndError.includes(icon)) icon = 'info';
        
                Swal.fire(
                    error.status,
                    error.message,
                    icon
                );
            });
        
            HideLoader();
            return data;
        }
    });
}

const getInputValIfNotSameError = (el1, el2) => {
    const value1 = getInputValIfNullError(el1);
    const value2 = getInputValIfNullError(el2);

    if (value1 != value2) {
        field_name1 = replaceAll(el1, "_", " ");
        field_name1 = replaceAll(el1, "#", "");
        field_name1 = replaceAll(el1, ".", "");
        field_name1 = capitalizeFirstLetter(el1);

        field_name2 = replaceAll(el2, "_", " ");
        field_name2 = replaceAll(el2, "#", "");
        field_name2 = replaceAll(el2, ".", "");
        field_name2 = capitalizeFirstLetter(el2);
        errorSwal(`${field_name1} Must Same with ${field_name2}`);
    }
    return value1;
}

const disabledElements = (nodes) => {
    nodes.forEach(node => {
        qSelect(`#${node}`).disabled = true;
    });
}

const enabledElements = (nodes) => {
    nodes.forEach(node => {
        qSelect(`#${node}`).removeAttribute('disabled');
    });
}

const hasClass = (element, className) => {
    return (' ' + element.className + ' ').indexOf(' ' + className+ ' ') > -1;
}

const openModal = (element) => {
    $(element).modal('show'); 
}

const closeModal = (element) => {
    $(element).modal('hide');
}

const toggleCollapse = (id) => {
    if ($(id).hasClass('show')) $(id).collapse('hide');
    else $(id).collapse('show');
}

const setModalTitle = (node, title) => {
    qSelect(`${node} .modal-title`).innerHTML = title;
}

const setModalBody = (node, body) => {
    qSelect(`${node} .modal-body`).innerHTML = body;
}

const setModalPrimaryButtonOnclick = (node, event) => {
    qSelect(`${node} .btn-primary`).setAttribute('onclick', event);
}

const setFieldsEnabled = (parentElement) => {
    const elements = qSelectAll(`${parentElement} input, ${parentElement} select, ${parentElement} textarea`);
    elements.forEach(element => {
        element.disabled = false;
    });
}