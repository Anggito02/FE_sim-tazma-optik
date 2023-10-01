const selectElementAddItem = document.querySelector('#choose_jenisItem');
const selectElementEditItem = document.querySelector('#edit_jenisItem');
const searchItemByJenis = document.getElementById('get_jenis_item');
const searchAddItemModal = document.querySelectorAll('.addItem');

const frameSubKategoriInput = document.querySelector('#frameSubKategori');
const frameSkuVendorInput = document.querySelector('#frameSkuVendor');
const kodeFrameInput = document.querySelector('#kodeFrame');
const jenisProdukLensaInput = document.querySelector('#jenisProdukLensa');
const jenisLensaInput = document.querySelector('#jenisLensa');
const namaItemAksesorisInput = document.querySelector('#namaItemAksesoris');
const kategoriAksesorisInput = document.querySelector('#kategoriAksesoris');
const indexLensaInput = document.querySelector('#indexLensa');

const frameSubKategoriEdit = document.querySelector('.frameSubKategoriEdit');
const frameSkuVendorEdit = document.querySelector('.frameSkuVendorEdit');
const kodeFrameEdit = document.querySelector('.kodeFrameEdit');
const jenisProdukLensaEdit = document.querySelector('.jenisProdukLensaEdit');
const jenisLensaEdit = document.querySelector('.jenisLensaEdit');
const namaItemAksesorisEdit = document.querySelector('.namaItemAksesorisEdit');
const kategoriAksesorisEdit = document.querySelector('.kategoriAksesorisEdit');

selectElementAddItem.addEventListener('change', function() {
    const selectedAddOption = selectElementAddItem.value;
    
    if (selectedAddOption === 'frame') {
        frameSubKategoriInput.disabled = false;
        frameSkuVendorInput.disabled = false;
        kodeFrameInput.disabled = false;
        indexLensaInput.disabled = true;
        jenisProdukLensaInput.disabled = true;
        jenisLensaInput.disabled = true;
        namaItemAksesorisInput.disabled = true;
        kategoriAksesorisInput.disabled = true;
        for (let i = 0; i < searchAddItemModal.length; i++) {
            searchAddItemModal[i].disabled = false;
        };
    } else if (selectedAddOption === 'lensa') {
        frameSubKategoriInput.disabled = true;
        frameSkuVendorInput.disabled = true;
        kodeFrameInput.disabled = true;
        indexLensaInput.disabled = false;
        jenisProdukLensaInput.disabled = false;
        jenisLensaInput.disabled = false;
        namaItemAksesorisInput.disabled = true;
        kategoriAksesorisInput.disabled = true;
        for (let i = 0; i < searchAddItemModal.length; i++) {
            searchAddItemModal[i].disabled = false;
        };
    } else if (selectedAddOption === 'aksesoris') {
        frameSubKategoriInput.disabled = true;
        frameSkuVendorInput.disabled = true;
        kodeFrameInput.disabled = true;
        indexLensaInput.disabled = true;
        jenisProdukLensaInput.disabled = true;
        jenisLensaInput.disabled = true;
        namaItemAksesorisInput.disabled = false;
        kategoriAksesorisInput.disabled = false;
        for (let i = 0; i < searchAddItemModal.length; i++) {
            searchAddItemModal[i].disabled = false;
        };
    } else {
        frameSubKategoriInput.disabled = true;
        frameSkuVendorInput.disabled = true;
        kodeFrameInput.disabled = true;
        indexLensaInput.disabled = true;
        jenisProdukLensaInput.disabled = true;
        jenisLensaInput.disabled = true;
        namaItemAksesorisInput.disabled = true;
        kategoriAksesorisInput.disabled = true;
        for (let i = 0; i < searchAddItemModal.length; i++) {
            searchAddItemModal[i].disabled = false;
        };
    };
});

selectElementEditItem.addEventListener('change', function() {
    const selectedEditOption = selectElementEditItem.value;

    if (selectedEditOption === 'frame') {
        frameSubKategoriEdit.style.display  = "block";
        frameSkuVendorEdit.style.display  = "block";
        kodeFrameEdit.style.display  = "block";
        jenisProdukLensaEdit.style.display  = "none";
        jenisLensaEdit.style.display  = "none";
        namaItemAksesorisEdit.style.display  = "none";
        kategoriAksesorisEdit.style.display  = "none";
    } else if (selectedEditOption === 'lensa') {
        frameSubKategoriEdit.style.display = "none";
        frameSkuVendorEdit.style.display = "none";
        kodeFrameEdit.style.display = "none";
        jenisProdukLensaEdit.style.display = "block";
        jenisLensaEdit.style.display = "block";
        namaItemAksesorisEdit.style.display = "none";
        kategoriAksesorisEdit.style.display = "none";
    } else if (selectedEditOption === 'aksesoris') {
        frameSubKategoriEdit.style.display = "none";
        frameSkuVendorEdit.style.display = "none";
        kodeFrameEdit.style.display = "none";
        jenisProdukLensaEdit.style.display = "none";
        jenisLensaEdit.style.display = "none";
        namaItemAksesorisEdit.style.display = "block";
        kategoriAksesorisEdit.style.display = "block";
    } 
});

searchItemByJenis.addEventListener('change', function() {
    document.getElementById('itemForm').submit();
})

$(document).ready(function() {
    $('#select2').select2({

    });
});
