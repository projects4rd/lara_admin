@can('edit-' . $entity)
    <a href="{{ route($entity.'.edit', [STR::singular($entity) => $id])  }}" class="btn btn-sm btn-light">
        <i class="fas fa-user-edit"></i></a>
@endcan

@can('delete-'  .$entity)
    <form method = 'post'
          action="route($entity . '.destroy', ['user' => $id])"
          style='display: inline'
          onSubmit='return confirm("Are yous sure wanted to delete it?")'>
    </form>
        @method('DELETE')
        <button type="submit" class="btn-delete btn btn-sm btn-light"><i class="fas fa-trash-alt"></i></button>
    </form>
@endcan
