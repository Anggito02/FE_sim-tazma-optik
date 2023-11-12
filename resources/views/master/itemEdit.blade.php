@section('content')
<div class="modal-body">
    <form method="post" action="/item/edit">
        @csrf
        @method("PUT")
        <div class="row">
            <input type="hidden" id="id" name="item_id" class="form-control" value="{{$vals['id']}}">
            <div class="col">
                <div class="mb-3">
                    <label for="InputItem" class="form-label">Jenis Item</label>
                    <input type="text" name="jenis_item" class="form-control" value="{{$vals['jenis_item']}}">
                </div>
                <div class="mb-3 ">
                    <label for="lensa_jenis_produk" class="form-label">Jenis Produk Lensa</label>
                    <input type="text" name="lensa_jenis_produk" class="form-control" value="{{$vals['lensa_jenis_produk']}}">
                </div>
                <div class="mb-3">
                    <label for="lensa_jenis_lensa" class="form-label">Jenis Lensa</label>
                    <input type="text" name="lensa_jenis_lensa" class="form-control" value="{{$vals['lensa_jenis_lensa']}}">
                </div>
                <div class="mb-3">
                    <label for="lens_category_id" class="form-label">Kategori Lensa</label>
                    <select type="text" name="lensa_lens_category_id" class="form-control">
                        @foreach ($lensaCategory as $val)
                        <option value="{{ $val['id'].'-'.$val['nama_kategori'] }}" {{ $val['id'] == $vals['lensa_lens_category_id'] ? 'selected' : ''}}> {{$val['nama_kategori']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" value="{{$vals['deskripsi']}}">
                </div>
            </div>

            <div class="col">

                <div class="mb-3">
                    <label for="" class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{$vals['stok']}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control" value="{{$vals['harga_beli']}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control" value="{{$vals['harga_jual']}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Brand Lensa</label>
                    <select type="text" name="lensa_brand_id" class="form-control">
                        @foreach ($brand as $val)
                        <option value="{{ $val['id'].'-'.$val['nama_brand'] }}" {{ $val['id'] == $vals['lensa_brand_id'] ? 'selected' : '' }}>{{ $val['nama_brand'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Index Lensa</label>
                    <select name="lensa_index_id" class="form-control" id="">
                        @foreach ($index as $val)
                        <option value="{{ $val['id'].'-'.$val['value'] }}" {{ $val['id'] == $vals['lensa_index_id'] ? 'selected' : '' }}>{{ $val['value'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-5 float-right">
                    <button type="submit" class="btn btn-success">Edit Item</button>
                </div>
            </div>
        </div>
    </form> 
</div>
@endsection
