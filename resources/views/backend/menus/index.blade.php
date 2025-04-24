@extends('backend.layouts.app', ['title' => 'Manage Menus'])
@section('content')

<div class="container py-3">
    <h5 class="mb-3 fw-bold">Header Menu Manager</h5>

    <form action="{{ route('menus.store') }}" method="POST">
        @csrf

        <ul id="menu-list" class="list-group mb-1">
            <!-- Menus will be inserted dynamically -->
        </ul>

        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addMenu()">+ Add Main Menu</button>
            <button type="submit" class="btn btn-sm btn-success">💾 Save Menus</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    let menuIndex = 0;

    function reindexMenus() {
        document.querySelectorAll('#menu-list > li').forEach((menuLi, i) => {
            menuLi.querySelectorAll('[name]').forEach(input => {
                input.name = input.name.replace(/menus\[\d+]/, `menus[${i}]`);
            });
            menuLi.querySelectorAll('.sub-menu-list li').forEach((subLi, j) => {
                subLi.querySelectorAll('[name]').forEach(input => {
                    input.name = input.name.replace(/\[sub_menus]\[\d+]/, `[sub_menus][${j}]`);
                });
            });
        });
    }

    function addMenu(title = '', subMenus = [], existingId = null) {
        const html = `
            <li class="list-group-item p-2 mb-1">
                <div class="d-flex flex-column gap-2">
                    ${existingId ? `<input type="hidden" name="menus[${menuIndex}][id]" value="${existingId}">` : ''}
                    <input type="text" name="menus[${menuIndex}][title]" class="form-control form-control-sm" placeholder="Main Menu Title" value="${title}" required>

                    <ul class="list-group sub-menu-list" id="sub-menu-${menuIndex}"></ul>

                    <div class="d-flex justify-content-between mt-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addSubMenu(${menuIndex})">+ Submenu</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeMenu(this)">✕ Remove</button>
                    </div>
                </div>
            </li>
        `;
        document.getElementById('menu-list').insertAdjacentHTML('beforeend', html);

        new Sortable(document.getElementById(`sub-menu-${menuIndex}`), {
            animation: 150,
            handle: '.drag-handle',
            onEnd: () => reindexMenus()
        });

        subMenus.forEach(sub => addSubMenu(menuIndex, sub.title, sub.link, sub.id));
        menuIndex++;
        reindexMenus();
    }

    function addSubMenu(menuIdx, title = '', link = '', existingId = null) {
        const container = document.getElementById(`sub-menu-${menuIdx}`);
        const subIdx = container.children.length;

        const html = `
            <li class="list-group-item px-2 py-1 d-flex align-items-center gap-1 mt-2" style="border: 0;">
                <span class="drag-handle" style="cursor: grab;">☰</span>
                ${existingId ? `<input type="hidden" name="menus[${menuIdx}][sub_menus][${subIdx}][id]" value="${existingId}">` : ''}
                <input type="text" name="menus[${menuIdx}][sub_menus][${subIdx}][title]" class="form-control form-control-sm" style="width: 25%;" placeholder="Title" value="${title}" required>
                <input type="text" name="menus[${menuIdx}][sub_menus][${subIdx}][link]" class="form-control form-control-sm" style="width: 55%;" placeholder="Link" value="${link}" required>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('li').remove(); reindexMenus();">✕</button>
            </li>
        `;
        container.insertAdjacentHTML('beforeend', html);
        reindexMenus();
    }

    function removeMenu(button) {
        button.closest('li').remove();
        reindexMenus();
    }

    new Sortable(document.getElementById('menu-list'), {
        animation: 150,
        handle: '.list-group-item',
        onEnd: () => reindexMenus()
    });

    @if(isset($menus) && $menus->count())
        @foreach($menus as $m)
            addMenu(
                @json($m->title),
                @json($m->subMenus),
                @json($m->id)
            );
        @endforeach
    @endif
</script>
@endsection
