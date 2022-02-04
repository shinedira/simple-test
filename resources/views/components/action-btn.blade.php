@foreach ($actions as $button => $action)
    @if ($button == 'edit')
        @if (isset($action['isShow']) ? $action['isShow'] : true)
            <a href="{{ @$action['prevent'] ? 'javascript:;' : $action['route'] }}"
                data-url="{{ $action['route'] }}"
                data-title="{{ @$action['title'] }}"
                class="btn btn-icon btn-sm btn-primary @if(@$action['prevent']) btn-action-modal @endif" data-toggle="tooltip"
                data-placement="top" title="" data-original-title="Edit">
                <i class="far fa-edit"></i>
            </a>
        @endif
    @endif

    @if ($button == 'detail')
        @if (isset($action['isShow']) ? $action['isShow'] : true)
            <a href="{{ @$action['prevent'] ? 'javascript:;' : $action['route'] }}"
                class="btn btn-icon btn-sm btn-info btn-detail" data-model="{{ @$action['model'] }}"  data-toggle="tooltip" data-placement="top"
                title="" data-original-title="Detail">
                <i class="fas fa-info-circle"></i>
            </a>
        @endif
    @endif

    @if ($button == 'delete')
        @if (isset($action['isShow']) ? $action['isShow'] : true)
            <a href="javascript:;" data-url="{{ $action['route'] }}"
            data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                class="btn btn-sm btn-danger delete">
                <i class="fas fa-times"></i>
            </a>
        @endif
    @endif
@endforeach
