const selectElementAddItem = document.querySelector('#choose_jenisItem');
const selectElementEditItem = document.querySelector('#edit_jenisItem');
const searchAddItemModal = document.querySelectorAll('.addItem');
const buttonAddItem = document.querySelector('.btn-new-item');
const buttonEditItem = document.querySelector('.btn-edit-item');

const frameSubKategoriInput = document.querySelector('#frameSubKategori');
const frameSkuVendorInput = document.querySelector('#frameSkuVendor');
const kategoriframeInput = document.querySelector('#kategoriFrame');
const kodeFrameInput = document.querySelector('#kodeFrame');
const jenisProdukLensaInput = document.querySelector('#jenisProdukLensa');
const brandLensaInput = document.querySelector('#brandLensa');
const brandFrameInput = document.querySelector('#brandFrame');
const colorItemInput = document.querySelector('#colorItem');
const jenisLensaInput = document.querySelector('#jenisLensa');
const kategoriLensaInput = document.querySelector('#kategoriLensa');
const brandAksesorisInput = document.querySelector('#brandAksesoris');
const namaItemAksesorisInput = document.querySelector('#namaItemAksesoris');
const kategoriAksesorisInput = document.querySelector('#kategoriAksesoris');
const indexLensaInput = document.querySelector('#indexLensa');
const vendorInput = document.querySelector('#vendorItem');

buttonAddItem.addEventListener('click', function() {
    const addDnone = document.querySelectorAll('.form-add-item');
    for (let i = 0; i < addDnone.length; i++) {
        addDnone[i].style.display = 'none';
    }
})

buttonEditItem.addEventListener('click', function() {
    const editDnone = document.querySelectorAll('.form-edit-item');
    for (let i = 0; i < editDnone.length; i++) {
        editDnone[i].style.display = 'none';
    }
})

selectElementAddItem.addEventListener('change', function() {
    console.log(selectElementAddItem.value);
    const selectedAddOption = selectElementAddItem.value;
    
    if (selectedAddOption === 'frame') {
        frameSubKategoriInput.style.display = 'block';
        frameSkuVendorInput.style.display = 'block';
        brandFrameInput.style.display = 'block';
        kategoriframeInput.style.display = 'block';
        colorItemInput.style.display = 'block';
        kodeFrameInput.style.display = 'block';
        vendorInput.style.display = 'block';
        kategoriLensaInput.style.display = 'none'; 
        indexLensaInput.style.display = 'none'; 
        jenisProdukLensaInput.style.display = 'none'; 
        brandLensaInput.style.display = 'none'; 
        jenisLensaInput.style.display = 'none'; 
        brandAksesorisInput.style.display = 'none'; 
        namaItemAksesorisInput.style.display = 'none'; 
        kategoriAksesorisInput.style.display = 'none'; 
        for (let i = 0; i < searchAddItemModal.length; i++) {
            searchAddItemModal[i].style.display = 'block';
        };
        // searchAddItemModal.classList.remove('d-none');
    } else if (selectedAddOption === 'lensa') {
        frameSubKategoriInput.style.display = "none";
        frameSkuVendorInput.style.display = "none";
        kategoriframeInput.style.display = "none";
        kodeFrameInput.style.display = "none";
        colorItemInput.style.display = "none";
        vendorInput.style.display = "none";
        kategoriLensaInput.style.display = "block";
        indexLensaInput.style.display = "block";
        brandLensaInput.style.display = "block";
        brandFrameInput.style.display = "none";
        jenisProdukLensaInput.style.display = "block";
        jenisLensaInput.style.display = "block";
        brandAksesorisInput.style.display = "none";
        namaItemAksesorisInput.style.display = "none";
        kategoriAksesorisInput.style.display = "none";
        for (let i = 0; i < searchAddItemModal.length; i++) {
            searchAddItemModal[i].style.display = 'block';
        };
    } else if (selectedAddOption === 'aksesoris') {
        frameSubKategoriInput.style.display = "none";
        frameSkuVendorInput.style.display = "none";
        kategoriframeInput.style.display = "none";
        colorItemInput.style.display = "none";
        kodeFrameInput.style.display = "none";
        vendorInput.style.display = "none";
        kategoriLensaInput.style.display = "none";
        indexLensaInput.style.display = "none";
        brandLensaInput.style.display = "none";
        brandFrameInput.style.display = "none";
        jenisProdukLensaInput.style.display = "none";
        jenisLensaInput.style.display = "none";
        brandAksesorisInput.style.display = "block";
        namaItemAksesorisInput.style.display = "block";
        kategoriAksesorisInput.style.display = "block";
        for (let i = 0; i < searchAddItemModal.length; i++) {
            searchAddItemModal[i].style.display = 'block';
        };
    } else {
        frameSubKategoriInput.style.display = "none";
        frameSkuVendorInput.style.display = "none";
        kategoriframeInput.style.display = "none";
        colorItemInput.style.display = "none";
        kodeFrameInput.style.display = "none";
        vendorInput.style.display = "none";
        kategoriLensaInput.style.display = "none";
        indexLensaInput.style.display = "none";
        brandLensaInput.style.display = "none";
        brandFrameInput .style.display = "none";
        jenisProdukLensaInput.style.display = "none";
        jenisLensaInput.style.display = "none";
        brandAksesorisInput.style.display = "none";
        namaItemAksesorisInput.style.display = "none";
        kategoriAksesorisInput.style.display = "none";
        for (let i = 0; i < searchAddItemModal.length; i++) {
            searchAddItemModal[i].style.display = 'none';
        };
    };
});