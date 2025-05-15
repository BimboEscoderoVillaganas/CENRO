<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/main.css">
    
    <link rel="stylesheet" href="../../assets/css/map.css">
        <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <!-- Pages -->
    <link rel="stylesheet" href="/CSS/main.css">
    <link rel="stylesheet" href="/CSS/book_list.css">
    <link rel="stylesheet" href="/CSS/insertion_section.css">
    <link rel="stylesheet" href="/assets/css/from.css">
    <script src="/JS/main.js"></script>
</head>
<body>
    <!-- Header Section -->
    <header class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-primary me-3 d-lg-none" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="ms-auto d-flex align-items-center">
                <!-- Notifications -->
                <div class="dropdown me-3">
                    <button class="btn btn-light dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                        <li><a class="dropdown-item" href="#">No new notifications</a></li>
                    </ul>
                </div>

                <!-- User Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> John Doe
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#">
                        <i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark text-white">
            <ul class="list-unstyled">
                <li>
                    <a href="dashboard.php" class="text-white nav-link">
                    <i class="bi bi-house-door me-2"></i>Home</a>
                </li>

                <li>
                    <a href="form.php" class="text-white nav-link">
                    <i class="bi bi-ui-checks-grid me-2"></i>Form</a>
                </li>
                
                <li>
                    <a href="records.php" class="text-white nav-link">
                    <i class="bi bi-archive me-2"></i>Records</a>
                </li>

                <li>
                    <a href="#profileSubmenu" data-bs-toggle="collapse" class="text-white nav-link">
                    <i class="bi bi-person me-2"></i> Profile</a>
                    <ul id="profileSubmenu" class="collapse list-unstyled">
                        <li><a href="#" class="text-white nav-link"><i class="bi bi-eye me-2"></i> View Profile</a></li>
                        <li><a href="#" class="text-white nav-link"><i class="bi bi-pencil-square me-2"></i>Edit Profile</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#settingsSubmenu" data-bs-toggle="collapse" class="text-white nav-link">
                    <i class="bi bi-gear me-2"></i> Settings</a>
                    <ul id="settingsSubmenu" class="collapse list-unstyled">
                        <li><a href="#" class="text-white nav-link"><i class="bi bi-shield-lock me-2"></i> Account Settings</a></li>
                        <li><a href="#" class="text-white nav-link"><i class="bi bi-lock me-2"></i> Privacy Settings</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="text-white nav-link">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow-1 p-4">
            

      <h1>form</h1>

    <section id="one-page">
        <div class="container">
            <!-- Title -->
            <div class="row">
                <h1 class="text-light">Input</h1>
            </div>

            <div class="row mt-4">
                <!-- insertion section -->
                <div class="col-lg-5" id="insertion_section">
                    <form class="form-group justify-content-center">
                        <div class="row" id="name-section">
                            <label for="bookName" class="text-light">Document Title</label>
                            <input type="text" class="form-control" id="bookName">
                        </div>
                        <div class="row" id="name-section">
                            <label for="bookName" class="text-light">Document Type</label>
                            <input type="text" class="form-control" id="bookName">
                        </div>
                        <div class="row" id="author-section">
                            <label for="authorName" class="text-light">Document Name</label>
                            <input type="text" class="form-control" id="authorName">
                        </div>
                        <div class="row" id="publisher-section">
                            <label for="publisherName" class="text-light">Year</label>
                            <input type="text" class="form-control" id="publisherName">
                        </div>
                        <div class="row" id="two-section">
                            <div class="col-6">
                                <label for="numberPage" class="text-light">Number of pages</label>
                                <input type="number" class="form-control" id="numberPage">
                            </div>
                            <div class="col-6">
                                <label for="serialNumber" class="text-light">Serial Number</label>
                                <input type="number" class="form-control" id="serialNumber">
                            </div>
                        </div>
                        <div class="add-button mt-4">
                            <button type="button" class="btn btn-danger btn-block" id="add" >ADD</button>
                        </div>
                      </from>
                </div>

                <!-- Book List -->
                <div class="col-lg-7" id="book_list">
                    <table class="table table-borderless table-striped mt-3 ">
                        <thead>
                            <tr>
                                <th scope="col">Document Title</th>
                                <th scope="col">Document Type</th>
                                <th scope="col">Date Created</th>
                                <th scope="col"></th>
                                <th scope="col">Serial</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabs">
                            <tr class="tab">
                                <th scope="row">The Hunger Games</th>
                                <td>Suzanne Collins</td>
                                <td>Alfa</td>
                                <td>478</td>
                                <td>1</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">Harry Potter</th>
                                <td>J.K. Rowling</td>
                                <td>Beta</td>
                                <td>398</td>
                                <td>2</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">To Kill a Mockingbird</th>
                                <td>Harper Lee  </td>
                                <td>Omega</td>
                                <td>685</td>
                                <td>3</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">Pride and Prejudice</th>
                                <td>Jane Austen</td>
                                <td>Sky</td>
                                <td>425</td>
                                <td>4</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">Twilight</th>
                                <td>Stephenie Meyer</td>
                                <td>Sun</td>
                                <td>556</td>
                                <td>5</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">The Book Thief</th>
                                <td>Markus Zusak</td>
                                <td>Child</td>
                                <td>475</td>
                                <td>6</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">Narnia</th>
                                <td>C.S. Lewis</td>
                                <td>Alfa</td>
                                <td>358</td>
                                <td>7</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">Animal Farm</th>
                                <td>George Orwell</td>
                                <td>Dog</td>
                                <td>277</td>
                                <td>8</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">Les Misérables</th>
                                <td>Victor Hugo</td>
                                <td>Dog</td>
                                <td>369</td>
                                <td>9</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">The Alchemist</th>
                                <td>Paulo Coelho</td>
                                <td>Omega</td>
                                <td>247</td>
                                <td>10</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">The Help</th>
                                <td>Kathryn Stockett</td>
                                <td>Clock</td>
                                <td>159</td>
                                <td>11</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">Charlotte's Web</th>
                                <td>E.B. White</td>
                                <td>Book</td>
                                <td>437</td>
                                <td>12</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">Dracula</th>
                                <td>Bram Stoker</td>
                                <td>Beta</td>
                                <td>346</td>
                                <td>13</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </section>
    

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
