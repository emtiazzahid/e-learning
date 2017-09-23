<?php $__env->startSection('title', 'Courses List'); ?>

<!-- page content -->
<?php $__env->startSection('content'); ?>

    <div class="right_col" role="main">

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if(isset($errors)): ?>
                <?php if( count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php endif; ?>
                <?php if(\Session::has('msg')): ?>

                <?php endif; ?>
                    <?php echo Breadcrumbs::render('courses'); ?>




                <div class="x_panel">

                    <div class="x_title">
                        <h2>Courses List</h2>
                        <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i>
                            <?php if(\Illuminate\Support\Facades\Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$ADMIN): ?>
                                Add Course
                            <?php else: ?>
                                Request new course
                            <?php endif; ?>
                        </button>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <?php if(count($courses)<1): ?>
                            <div class="alert alert-dismissible fade in alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry !</strong> No Data Found.
                            </div>
                        <?php else: ?>
                        <?php $index = 0; ?>
                        <table class="table table-striped table-bordered dataTable no-footer" id="data">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Department</th>
                                <th>Title</th>
                                <th>Short Code</th>
                                <th>Status</th>
                                <?php if(\Illuminate\Support\Facades\Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$ADMIN): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e(++$index); ?></strong></td>
                                    <td><?php echo e($course->department_title); ?></td>
                                    <td><?php echo e($course->title); ?></td>
                                    <td><?php echo e($course->short_code); ?></td>
                                    <td>
                                        <?php if($course->status == \App\Libraries\Enumerations\CourseStatus::$PENDING): ?>
                                            <span class="label label-default">Pending</span>
                                        <?php elseif($course->status == \App\Libraries\Enumerations\CourseStatus::$APPROVED): ?>
                                            <span class="label label-success">Approved</span>
                                        <?php elseif($course->status == \App\Libraries\Enumerations\CourseStatus::$APPROVED): ?>
                                            <span class="label label-warning">Banned</span>
                                        <?php else: ?>

                                        <?php endif; ?>
                                    </td>
                                    <?php if(\Illuminate\Support\Facades\Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$ADMIN): ?>
                                    <td class="text-center">
                                        <button type="button"
                                                data-id="<?php echo e($course->id); ?>"
                                                data-department_id="<?php echo e($course->department_id); ?>"
                                                data-title="<?php echo e($course->title); ?>"
                                                data-short_code="<?php echo e($course->short_code); ?>"
                                                data-featured_text="<?php echo e($course->featured_text); ?>"
                                                data-status="<?php echo e($course->status); ?>"
                                                data-featured_image="<?php echo e($course->featured_image); ?>"
                                                data class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>

                                      <a href="<?php echo e(route('courses-delete', ['id'=>$course->id])); ?>" class="delete" title="Delete"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <!--Update Modal -->
        <div class="modal fade" id="updateModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Info</h4>
                    </div>
                    <form action="<?php echo e(route('courses-update')); ?>" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                                <table class="table">
                                    <input type="hidden" name="modal_id" id="modal_id">
                                    <tr>
                                        <td colspan="2"><label>Department</label></td>
                                        <td colspan="2">
                                            <select name="department" id="modal_department_id" required class="form-control">
                                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($department->id); ?>"><?php echo e($department->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Title</label></td>
                                        <td colspan="2">
                                            <input type="text" name="title" class="form-control" id="modal_title" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Short Code</label></td>
                                        <td colspan="2">
                                            <input type="text" name="short_code" class="form-control" id="modal_short_code" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Featured Image</label></td>
                                        <td colspan="2">
                                            <img src="" id="modal_featured_image" alt="..." style="max-width: 150px; max-height: 150px">
                                            <input type="file" name="new_featured_image" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Featured Text</label></td>
                                        <td colspan="2">
                                            <textarea name="featured_text" class="form-control" id="modal_featured_text"></textarea>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"><label>Status</label></td>
                                        <td colspan="2">
                                            <select class="form-control" name="status" id="modal_status">
                                                <option value="<?php echo e(\App\Libraries\Enumerations\DepartmentStatus::$APPROVED); ?>">Approve</option>
                                                <option value="<?php echo e(\App\Libraries\Enumerations\DepartmentStatus::$PENDING); ?>">Pending</option>
                                                <option value="<?php echo e(\App\Libraries\Enumerations\DepartmentStatus::$BANNED); ?>">Banned</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>


                            <button type="submit" class="btn btn-default pull-right">Update</button>
                    </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>
        </div>
    

    <!--Add Modal -->
        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Info</h4>
                    </div>
                    <form action="<?php echo e(route('courses-add')); ?>" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">
                            <div class="col-md-8">
                                <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                                <table class="table">
                                    <tr>
                                        <td colspan="2"><label>Department</label></td>
                                        <td colspan="2">
                                            <select name="department" id="department" required class="form-control">
                                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($department->id); ?>"><?php echo e($department->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Title</label></td>
                                        <td colspan="2">
                                            <input type="text" name="title" class="form-control" id="title" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Short Code</label></td>
                                        <td colspan="2">
                                            <input type="text" name="short_code" class="form-control" id="short_code" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Featured Image</label></td>
                                        <td colspan="2">
                                            <input type="file" name="featured_image" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label>Featured Text</label></td>
                                        <td colspan="2">
                                            <textarea name="featured_text" class="form-control"></textarea>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <button type="submit" class="btn btn-default pull-right">Submit</button>
                    </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>
        </div>
    
<?php $__env->stopSection(); ?>
<!-- /page content -->

<?php $__env->startSection('page_js'); ?>
    <script>
        $('#updateModal').on('show.bs.modal', function (e) {
            $('#modal_id').val($(e.relatedTarget).data('id'));
            $('#modal_department_id').val($(e.relatedTarget).data('department_id'));
            $('#modal_title').val($(e.relatedTarget).data('title'));
            $('#modal_short_code').val($(e.relatedTarget).data('short_code'));
            $('#modal_status').val($(e.relatedTarget).data('status'));
            $('#modal_featured_image').attr('src' , $(e.relatedTarget).data('featured_image'));
            $('#modal_featured_text').text($(e.relatedTarget).data('featured_text'));
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#data').DataTable({
                dom: "Bfrtip",
                buttons: [
                    {
                        extend: "copy",
                        className: "btn-sm"
                    },
                    {
                        extend: "csv",
                        className: "btn-sm"
                    },
                    {
                        extend: "excel",
                        className: "btn-sm"
                    },
                    {
                        extend: "pdfHtml5",
                        className: "btn-sm"
                    },
                    {
                        extend: "print",
                        className: "btn-sm"
                    },
                ],
                responsive: true
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>