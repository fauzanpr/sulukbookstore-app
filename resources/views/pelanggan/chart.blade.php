@extends('pelanggan.layout.masterlayout')

@section('content')
<form class="bg0 p-t-75 p-b-85 mt-5">
    <div class="container">
        <div class="row">

            

            <div class="m-l-25 m-r--38 m-lr-0-xl">
                <h3 class="mb-5 mt-5">Keranjang Saya</h3>
                <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart">
                        <tr class="table_head">
                            <th style="width: 50px;"></th>
                            <th class="column-1">Buku</th>
                            <th class="column-2"></th>
                            <th class="column-3">Harga</th>
                            <th class="column-4 text-center">Item</th>
                            <th class="column-5">Total</th>
                            <th class="column-5">Aksi</th>
                        </tr>

                        {{-- chart item --}}
                        <tr class="table_row">
                            <td>
                                <input class="text-center me-5" type="checkbox" value="ini nanti id chart item" name="id[ini id chart item juga]" aria-label="..." style="width: 50px !important;">
                            </td>
                            <td >
                                <div class="how-itemcart1">
                                    <img src="images/product-01.jpg" alt="IMG">
                                </div>
                            </td>
                            <td class="column-2">Fresh Strawberries</td>
                            <td class="column-3">$ 36.00</td>
                            <td class="column-4 text-center">
                                1
                            </td>
                            <td class="column-5">$ 36.00</td>
                            <td class="column-5">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editchartitem">
                                    <i class="las la-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="las la-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        {{-- chart item end --}}

                    </table>
                </div>

                <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                    <button type="submit" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                        Checkout
                    </button>
                </div>
            </div>

        </div>
    </div>
</form>

{{-- edit chart item modal --}}
<form method="post" action="">
    <div class="modal fade" id="editchartitem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Fresh Strawberries</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-3 mb-3">
                    <div class="wrap-num-product flex-w m-l-auto">
                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-minus"></i>
                        </div>
    
                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="1">
    
                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                            <i class="fs-16 zmdi zmdi-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">simpan</button>
            </div>
          </div>
        </div>
      </div>
</form>
@endsection