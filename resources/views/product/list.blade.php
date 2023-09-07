<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('product.create') }}">
                                {{ __('Add New Product') }}
                            </a>

                            @foreach($products as $product)
                                <tr>
                                    <td width="30%">{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>
                                        <img src="{{url('storage/photo/'.$product->photo)}}" width="50" height="50">
                                        
                                    </td>
                                    <td>
                                        <a href="{{route('product.edit', ['product' => $product])}}">
                                            Edit
                                        </a>
                                        &nbsp;|&nbsp;
                                        <a href="#" data-id="{{$product->id}}" class="btnDel">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="" id="delform">
        @csrf
        @method('DELETE')
        <input type="hidden" name="product_id" />
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".btnDel").click(function() {
                if (confirm('Really mean to delete this product?')) {
                    let id = $(this).attr('id');
                    $("#delform").attr('action', '{{url('product.delete')}}/' + id);
                    $("#delform").submit();
                }
            });
        });
    </script>
</x-app-layout>
