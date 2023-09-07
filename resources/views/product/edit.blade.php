<x-guest-layout>
    <form method="POST" action="{{ route('product.update', ['product' => $product]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h1>Edit/Update The Product</h1>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $product->name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Product photo -->
        <div class="mt-4">
            <x-input-label for="photo" :value="__('photo (Optional)')" />
            <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>

        <!-- Product description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" class="block mt-1 w-full" name="description" required>{{old('description') ?? $product->description}}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
