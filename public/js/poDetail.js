const selectDetailItem = document.querySelector('#select_item');
const displayFrame = document.querySelector('.frame-detail');
const displayLensa = document.querySelector('.lensa-detail');
const displayAksesoris = document.querySelector('.aksesoris-detail');

selectDetailItem.addEventListener('change', function() {
    console.log(selectDetailItem.value);
    const selectedDetailOption = selectDetailItem.value;
    const addDetail = document.querySelectorAll('#add_detail');

    if (selectedDetailOption === 'frame') {
        for (let i = 0; i < addDetail.length; i++) {
            addDetail[i].removeAttribute('disabled');
        }
        displayFrame.style.display = 'block'
        // displayLensa.style.display = 'none'
        // displayAksesoris.style.display = 'none'
        
    } else if (selectedDetailOption === 'lensa') {
        for (let i = 0; i < addDetail.length; i++) {
            addDetail[i].removeAttribute('disabled');
        }
        displayFrame.style.display = 'block'
        // displayLensa.style.display = 'block'
        // displayAksesoris.style.display = 'none'
    } else if (selectedDetailOption === 'aksesoris') {
        for (let i = 0; i < addDetail.length; i++) {
            addDetail[i].removeAttribute('disabled');
        }
        displayFrame.style.display = 'block'
        // displayLensa.style.display = 'none'
        // displayAksesoris.style.display = 'block'
    }
})