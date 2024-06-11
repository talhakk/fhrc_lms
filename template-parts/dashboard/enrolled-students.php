<section class="enrolled-students">
    <div class="container">
        <div class="inner">
            <div class="head small dashboard-h2">
                <div class="filters-wrapper d-flex align-items-center">
                    <h2>Enrolled Users</h2>
                    <div class="filters-btns">
                        <a href="" class="bordered-btn filter-submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                <path d="M8.33333 15.79H11.6667V14.1234H8.33333V15.79ZM2.5 5.79004V7.45671H17.5V5.79004H2.5ZM5 11.6234H15V9.95671H5V11.6234Z" fill="#2D2F31"></path>
                            </svg>Filter</a>
                        <span class="bordered-btn">
                            <div class="sort-by">
                                <p>Sort by</p>
                                <select name="" id="">
                                    <option value="popular" selected="">Age</option>
                                    <option value="popular">Status</option>
                                    <option value="popular">Courses</option>
                                    <option value="popular">Date</option>
                                </select>
                            </div>
                        </span>
                    </div>
                </div>
                <a href="/signup" class="btn">Export CSV</a>
            </div>
            <div class="students-table">
                <table class="table-striped" id="students-table" cellpadding="5px">
                    <thead>
                        <tr>
                            <th width="5%"><input type="checkbox" id="selectall" class="regular-checkbox" /><label for="selectall"></th>
                            <th width="5%">Image</th>
                            <th width="20%">Name</th>
                            <th width="20%">Date</th>
                            <th width="20%">Training Course</th>
                            <th width="10%">Amount</th>
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center"><input type="checkbox" name="name" class="regular-checkbox name" value="1" id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
                            <td><img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt=""></td>
                            <td>Heather</td>
                            <td>September 9, 2022</td>
                            <td>Mental Health Aid</td>
                            <td>$11.70</td>
                            <td><span class="badge rounded-pill bg-success">Week 1</span></td>
                            <td>
                                <div class="dropdown action-wrapper d-flex align-items-center justify-content-center">
                                    <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                        <li><a class="dropdown-item" href="#">View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><input type="checkbox" name="name" class="regular-checkbox name" value="1" id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
                            <td><img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt=""></td>
                            <td>Heather</td>
                            <td>September 9, 2022</td>
                            <td>Mental Health Aid</td>
                            <td>$11.70</td>
                            <td><span class="badge rounded-pill bg-success">Week 1</span></td>
                            <td>
                                <div class="dropdown action-wrapper d-flex align-items-center justify-content-center">
                                    <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                        <li><a class="dropdown-item" href="#">View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><input type="checkbox" name="name" class="regular-checkbox name" value="1" id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
                            <td><img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt=""></td>
                            <td>Heather</td>
                            <td>September 9, 2022</td>
                            <td>Mental Health Aid</td>
                            <td>$11.70</td>
                            <td><span class="badge rounded-pill bg-success">Week 1</span></td>
                            <td>
                                <div class="dropdown action-wrapper d-flex align-items-center justify-content-center">
                                    <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                        <li><a class="dropdown-item" href="#">View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><input type="checkbox" name="name" class="regular-checkbox name" value="1" id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
                            <td><img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt=""></td>
                            <td>Heather</td>
                            <td>September 9, 2022</td>
                            <td>Mental Health Aid</td>
                            <td>$11.70</td>
                            <td><span class="badge rounded-pill bg-success">Week 1</span></td>
                            <td>
                                <div class="dropdown action-wrapper d-flex align-items-center justify-content-center">
                                    <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                        <li><a class="dropdown-item" href="#">View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><input type="checkbox" name="name" class="regular-checkbox name" value="1" id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
                            <td><img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt=""></td>
                            <td>Heather</td>
                            <td>September 9, 2022</td>
                            <td>Mental Health Aid</td>
                            <td>$11.70</td>
                            <td><span class="badge rounded-pill bg-success">Week 1</span></td>
                            <td>
                                <div class="dropdown action-wrapper d-flex align-items-center justify-content-center">
                                    <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                        <li><a class="dropdown-item" href="#">View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><input type="checkbox" name="name" class="regular-checkbox name" value="1" id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
                            <td><img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt=""></td>
                            <td>Heather</td>
                            <td>September 9, 2022</td>
                            <td>Mental Health Aid</td>
                            <td>$11.70</td>
                            <td><span class="badge rounded-pill bg-success">Week 1</span></td>
                            <td>
                                <div class="dropdown action-wrapper d-flex align-items-center justify-content-center">
                                    <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                        <li><a class="dropdown-item" href="#">View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><input type="checkbox" name="name" class="regular-checkbox name" value="1" id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
                            <td><img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt=""></td>
                            <td>Heather</td>
                            <td>September 9, 2022</td>
                            <td>Mental Health Aid</td>
                            <td>$11.70</td>
                            <td><span class="badge rounded-pill bg-success">Week 1</span></td>
                            <td>
                                <div class="dropdown action-wrapper d-flex align-items-center justify-content-center">
                                    <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                        <li><a class="dropdown-item" href="#">View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><input type="checkbox" name="name" class="regular-checkbox name" value="1" id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
                            <td><img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt=""></td>
                            <td>Heather</td>
                            <td>September 9, 2022</td>
                            <td>Mental Health Aid</td>
                            <td>$11.70</td>
                            <td><span class="badge rounded-pill bg-success">Week 1</span></td>
                            <td>
                                <div class="dropdown action-wrapper d-flex align-items-center justify-content-center">
                                    <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                        <li><a class="dropdown-item" href="#">View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><input type="checkbox" name="name" class="regular-checkbox name" value="1" id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
                            <td><img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt=""></td>
                            <td>Heather</td>
                            <td>September 9, 2022</td>
                            <td>Mental Health Aid</td>
                            <td>$11.70</td>
                            <td><span class="badge rounded-pill bg-success">Week 1</span></td>
                            <td>
                                <div class="dropdown action-wrapper d-flex align-items-center justify-content-center">
                                    <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                        <li><a class="dropdown-item" href="#">View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center"><input type="checkbox" name="name" class="regular-checkbox name" value="1" id="checkbox-1-1" /><label for="checkbox-1-1"></label></td>
                            <td><img class="user-profile-pic" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heather.png'); ?>" alt=""></td>
                            <td>Heather</td>
                            <td>September 9, 2022</td>
                            <td>Mental Health Aid</td>
                            <td>$11.70</td>
                            <td><span class="badge rounded-pill bg-success">Week 1</span></td>
                            <td>
                                <div class="dropdown action-wrapper d-flex align-items-center justify-content-center">
                                    <button type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                        <li><a class="dropdown-item" href="#">View</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    jQuery(document).ready(function($) {
        var table = $('#students-table').DataTable({
            "dom": '<"top">rt<"bottom"><"clear">',
            "responsive": true,
            "rowReorder": {
                "selector": 'td:nth-child(2)'
            }
        });

        // add multiple select/deselect functionality
        $("#selectall").click(function() {
            $('.name').prop('checked', this.checked);
        });

        // if all checkboxes are selected, then check the select all checkbox
        // and vice versa
        $(document).on('click', '.name', function() {
            if ($(".name").length == $(".name:checked").length) {
                $("#selectall").prop("checked", true);
            } else {
                $("#selectall").prop("checked", false);
            }
        });
    });
</script>