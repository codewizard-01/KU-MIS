<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Search</title>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <!-- Include Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  body {
    margin: 0;
    overflow: hidden;
  }

  .video-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1;
    opacity: 0.8;
  }

  .content {
    position: relative;
    z-index: 1;
    color: white;
    text-align: center;
    padding: 50px;
  }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid container">
      <a class="navbar-brand" href="#">Kabul University</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Publications</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Researches
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container mt-5 content">
    <h1 class="text-center">Search for Faculty</h1>

    <!-- Search Form -->
    <form id="faculty-form" class="my-4">
      <div class="mb-3">
        <label for="faculty_name" class="form-label">Enter Faculty Name:</label>
        <div class="input-group">
          <input type="text" class="form-control" name="faculty_name" id="faculty_name"
            placeholder="Enter Faculty Name">
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </div>
    </form>

    <!-- Dropdown Selection -->
    <div class="mb-4">
      <label for="faculty_dropdown" class="form-label">Or Select a Faculty:</label>
      <select class="form-select" id="faculty_dropdown">
        <option value="" disabled selected>Select a Faculty</option>
        <!-- Example Faculty Options -->
        <option value="Science">Science</option>
        <option value="Engineering">Engineering</option>
        <option value="Arts">Arts</option>
        <option value="Business">Business</option>
      </select>
    </div>

    <!-- Departments List -->
    <div id="departments"></div>
  </div>
  <!-- Video Background -->
  <video class="video-background" autoplay muted loop>
    <source src="{{ asset('/video.mp4') }}" type="video/mp4">
    <source src="{{ asset('/video.webm') }}" type="video/webm">
    Your browser does not support the video tag.
  </video>

  <script>
  // Function to fetch and display departments
  function fetchDepartments(facultyName) {
    axios.post('/fetch-departments', {
        faculty_name: facultyName
      })
      .then(response => {
        const departmentsDiv = document.getElementById('departments');
        departmentsDiv.innerHTML = '';

        if (response.data.success) {
          const departments = response.data.departments;

          if (departments.length) {
            const listGroup = document.createElement('ul');
            listGroup.className = 'list-group';

            departments.forEach(department => {
              const listItem = document.createElement('li');
              listItem.className = 'list-group-item';
              listItem.textContent = department.name;
              listGroup.appendChild(listItem);
            });

            departmentsDiv.appendChild(listGroup);
          } else {
            departmentsDiv.innerHTML = '<div class="alert alert-warning">No departments found.</div>';
          }
        } else {
          departmentsDiv.innerHTML = `<div class="alert alert-danger">${response.data.message}</div>`;
        }
      })
      .catch(error => console.error(error));
  }

  // Handle form submission
  document.getElementById('faculty-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const facultyName = document.getElementById('faculty_name').value;
    if (facultyName) fetchDepartments(facultyName);
  });

  // Handle dropdown selection
  document.getElementById('faculty_dropdown').addEventListener('change', function() {
    const selectedFaculty = this.value;
    if (selectedFaculty) fetchDepartments(selectedFaculty);
  });
  </script>

  <!-- Include Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>