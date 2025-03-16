@props([
    'tag'  => null,
    'task' => false
])

<div class="w-full flex py-2 border-b border-gray-100">
    <div class="w-5/12 flex items-center">{{ $tag?->name }}</div>
    <div class="w-5/12 flex flex-wrap">
        <x-elements.link-button class="mr-2 my-1 w-[110px]" href="{{ route('tags.edit', ['tag' => $tag]) }}">
            Edit
        </x-elements.link-button>
        @if($task)
            <x-elements.link-button-danger class="mr-2 my-1 w-[110px]" href="{{ route('tasks.removeTag', ['task' =>  $task, 'tag' => $tag]) }}">
                Remove
            </x-elements.link-button-danger>
        @else
            <x-elements.link-button-danger class="mr-2 my-1 w-[110px]" href="{{ route('tags.destroy', ['tag' => $tag]) }}">
                Delete
            </x-elements.link-button-danger>
        @endif
    </div>
</div>
