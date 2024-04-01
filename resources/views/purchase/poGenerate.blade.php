<div class="modal-body">
  <div id="qrcode">
    <div class="d-flex flex-column align-items-center">
      <div class="mb-4">
        {{ QrCode::size(250)->generate($qr_pod['kode_qr_po_detail']) }}
      </div>
      <div class="mb-1">
        <p class="black-text">{{$qr_pod['kode_item']}}</p>
      </div>
      <div class="mb-3">
        <p class="black-text">{{$qr_pod['kode_qr_po_detail']}}</p>
      </div>
    </div>
  </div>
</div>
