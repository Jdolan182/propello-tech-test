@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form method="POST" action="{{ route('tasks.update', ['task' =>  $task]) }}">
                <!-- fix bug !-->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  


                <div class="pb-4">
                    <x-forms.input-label for="name" :value="__('Name')" />
                    <x-forms.text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$task->name" required autofocus />
                    <x-forms.input-error :messages="$errors->get('name')" class="mt-2" />
                </div>


                
                @if($tags->count() > 0)
                    <h2>Tags</h2>
                    @foreach($tags as $tag)
                        <x-partials.tag-row :tag="$tag" :task="$task" />
                    @endforeach
                @endif



                </br>

                <x-elements.primary-button>
                    Update
                </x-elements.primary-button>

             

                <event-button  {{ $tagOptions->count() == 0 ? 'disabled' : '' }}  text="Tags" name="open-modal" value="add-tags-to-task" class="ml-4"></event-button>

                <form-modal name="add-tags-to-task" action="{{  route('tasks.addTags', ['task' =>  $task]) }}">

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Add tag to this task') }}
                    </h2>

                    <div class="mt-6">
                        <!-- TODO would change to a select where you can select multiple options but kept it easy !-->
                         <select name="tags[]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"> 
                            @foreach($tagOptions as $option)
                                <option value={{ $option->id }} > {{ $option->name }} </option>
                            @endforeach
                        </select>

                    </div>
                </form-modal>
            </form>
        </div>
    </div>
@endsection
