<x-app-layout>
    @if(Auth::check() && Auth::user() -> id == 1)
        @foreach($works as $item)
                <form method="POST" action="{{route('work.update')}}">
                    @csrf
                    <div>
                        {{$item->name}} {{$item->middlename}}
                    </div>

                    @if($item->score == 0)
                    <input type="text" value="{{$item->id}}" hidden =true name="id" id="id">
                    <input type="text" value="{{$item->title}}" hidden =true name="title" id="title">
                    <input type="text" value="{{$item->path_img}}" hidden =true name="path_img" id="path_img">
                    <input type="text" value="{{$item->user_id}}" hidden =true name="user_id" id="user_id">
                    <input type="text" value="{{$item->category_id}}" hidden =true name="category_id" id="category_id">
                    <div>
                        <x-input-label for="score" :value="__('Оценка')" />
                        <x-text-input class="block mt-1 w-full" type="text" name="score" id="score" :value="old('score')" required autofocus autocomplete="score" />
                        <x-input-error :messages="$errors->get('score')" class="mt-2" />
                    </div>
                    <x-primary-button class="ms-4">
                        {{ __('Оценить') }}
                    </x-primary-button>
                    @else
                    <div>
                        {{$item->score }}
                    </div>
                    @endif
                    
                </form>
        @endforeach
    @else
    <x-slot name="header">
        КУЧА ТЕКСТА
        <x-responsive-nav-link :href="route('work.create')" :active="request()->routeIs('work.create')">
            {{ __('Подача заявки') }}
        </x-responsive-nav-link> 
    </x-slot>
    @endif
</x-app-layout>
