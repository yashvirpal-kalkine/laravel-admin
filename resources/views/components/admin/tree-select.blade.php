{{-- @props(['items', 'selected' => null, 'level' => 0])

@foreach($items as $item)
    <option value="{{ $item->id }}" {{ $selected == $item->id ? 'selected' : '' }}>
        {{ str_repeat('— ', $level) }}{{ $item->name }}
    </option>

    @if($item->children->count())
        <x-tree-select :items="$item->children" :selected="$selected" :level="$level + 1" />
    @endif
@endforeach --}}
{{-- <x-tree-select :items="$categories" />
                             <x-tree-select :items="$categories" :selected="$category->parent_id" />
                                <x-tree-select :items="$blogCategories" :selected="$blogCategory->parent_id ?? null" />
<x-tree-select :items="$pages" :selected="$page->parent_id ?? null" /> --}}
@props(['items', 'selected' => null, 'level' => 0])

@foreach($items as $item)
    <option value="{{ $item->id }}" {{ (string)$selected === (string)$item->id ? 'selected' : '' }}>
        {{ str_repeat('— ', $level) }}{{ $item->title ?? $item->name }}
    </option>

    @if ($item->children && $item->children->count())
        <x-admin.tree-select :items="$item->children" :selected="$selected" :level="$level + 1" />
    @endif
@endforeach
