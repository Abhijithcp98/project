<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Student Management System</a>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <h1 class="mb-4">Student List</h1>
            <form action="<?php echo base_url('index.php/student/view'); ?>" method="get" class="form-inline mb-4">
                <label for="search" class="mr-2">Search by Student Name:</label>
                <div class="col-sm-4">
                    <input type="text" name="search" placeholder="Search Your Stock" value="<?php echo $this->input->get('search'); ?>">
                    <button type="submit">Search</button>
                </div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name of Student</th>
                        <th>Parent Name</th>
                        <th>Opted Course</th>
                        <th>Enable or Disable</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($student_opted_courses)): ?>  
                        <?php foreach ($student_opted_courses as $course): ?>
                        <tr>
                            <td><?php echo $course['student_name']; ?></td>
                            <td><?php echo $course['parent_name']; ?></td>
                            <td><?php echo $course['course_name']; ?></td>
                            <td>
                                <button class="toggle-status btn btn-<?php echo $course['is_active'] ? 'success' : 'secondary'; ?>" data-id="<?php echo $course['student_id']; ?>" data-status="<?php echo $course['is_active']; ?>">
                                    <?php echo $course['is_active'] ? 'Enable' : 'Disable'; ?>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No records found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
                <div class="page-container" style="align-items: center;width:60px; height:50px; background-color:grey;" >
                    <div class="pagination-links" style="align-items: center;padding:10px;color:#fff;">
                        <?php echo $links; ?>
                    </div>
                </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.toggle-status').click(function() {
            var id = $(this).data('id');
            var status = $(this).data('status') == 1 ? 0 : 1;
            var button = $(this);

            $.ajax({
                url: '<?php echo base_url('index.php/student/update_status'); ?>',
                type: 'POST',
                data: {id: id, status: status},
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 'success') {
                        button.data('status', status);
                        button.removeClass('btn-success btn-secondary');
                        button.addClass(status == 1 ? 'btn-success' : 'btn-secondary');
                        button.text(status == 1 ? 'Enable' : 'Disable');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX error: " + status + " - " + error);
                }
            });
        });
    });
    </script>
</body>
</html>
