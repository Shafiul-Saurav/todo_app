<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Toastr -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <title>Hello, world!</title>

    <style>
        .btn_custom {
            font-size: 13px;
            color: #bfc9d4;
            background-color: transparent !important;
            border: 0;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center pb-3">
                        <h5 class="card-header px-0 text-primary border-0">To Do Index / List Page</h5>
                        <div>
                            <a href="{{ route('todos.create') }}" class="btn btn-primary">Add New</a>
                        </div>

                    </div>
                    <table id="dataTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Last Update</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $todo)
                                <tr>
                                    <td>
                                        <strong>{{ $todos->firstItem() + $loop->index }}</strong>
                                    </td>
                                    <td>{{ $todo->updated_at->format('d-M-Y') }}</td>
                                    <td>{{ $todo->title }}</td>
                                    {{-- <td>
                                        <div class="form-check form-switch form-check-inline form-switch-success">
                                            <input class="form-check-input toggle-class" type="checkbox" role="switch"
                                                id="{{ $category->id }}" {{ $category->is_active ? 'checked' : '' }}
                                                data-id="{{ $category->id }}">
                                        </div>
                                    </td> --}}
                                    <td>
                                        @if ($todo->is_completed == 0)
                                        <span class="badge bg-success">Completed</span>

                                        @else
                                            <span class="badge bg-danger">Incompleted</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="action-btns d-flex">
                                            <div>
                                                <a href="{{ route('todos.edit', $todo->id) }}"
                                                    class="action-btn bs-tooltip me-1" data-toggle="tooltip"
                                                    data-placement="top" title="" data-bs-original-title="Edit">
                                                    <i class="fa-regular fa-pen-to-square text-primary"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <form action="{{ route('todos.destroy', $todo->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="action-btn bs-tooltip btn_custom show_confirm"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-bs-original-title="Delete"><i
                                                            class="fa-solid fa-trash-can text-danger"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>




<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Toastr -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.11/dist/sweetalert2.all.min.js"></script>
<script>
    new DataTable('#dataTable');

    $('.show_confirm').click(function(event){
            let form = $(this).closest('form');

            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                })
        })
</script>
</body>
</html>
