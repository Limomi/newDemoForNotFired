<x-app-layout>
    @if($works->count()==0)
        <form method="post" enctype="multipart/form-data" action="{{route('work.store')}}">
        @csrf
            <div>
                <x-input-label for="title" :value="__('Название')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="path_img" :value="__('Название')" />
                <x-text-input id="path_img" class="block mt-1 w-full" type="file" name="path_img" :value="old('path_img')" required autofocus autocomplete="path_img" />
                <x-input-error :messages="$errors->get('path_img')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="category_id" :value="__('Первая категория')" />
                <x-text-input id="category_id" class="block mt-1 w-full" type="radio" name="category_id" :value="old('первая')" required autofocus autocomplete="category_id" />
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="category_id" :value="__('Вторая категория')" />
                <x-text-input id="category_id" class="block mt-1 w-full" type="radio" name="category_id" :value="old('Вторая')" required autofocus autocomplete="category_id" />
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <x-primary-button class="ms-4">
                {{ __('Отправить') }}
            </x-primary-button>
        </form>
    @else
    <p>
        Вы уже отправили работу, желаем вам удачи!
    </p>
    @endif
</x-app-layout>