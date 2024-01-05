<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Prescription view</title>
    <link rel="stylesheet" href="pviewinterface.css">



</head>

<body>

    <form >
        <nav id="nav1">
            <a href="" class="A1">Telephone</a>
            <a href="" class="A1">Branches</a>
            <a href="" class="A1">My Account</a>


        </nav>
        <p id="p1">HEALTHCARE<br>
            PHARMACY</p>

        <div id="search">
            <input type="text" class="search-input" placeholder="Search...">
        </div>

        <div id="upload-prescription">

            <button class="upload">Upload Prescription</button>
        </div>

        <nav id="nav2">
            <ul id="ul1">
                <li class="Medicine">
                    <a class="a1">MEDICINE</a>
                    <div class="dropdown-medicine">
                        <a class="a2" href="">HEART</a>
                        <a class="a2" href="">CENTRAL NERVOUS SYSTEM</a>
                        <a class="a2" href=""> EAR, NOSE, THROAT</a>
                        <a class="a2" href=""> DIABETES</a>
                        <a class="a2 " href="">EYE</a>
                        <a class="a2" href=""> GASTRO INTESTINAL SYSTEM</a>
                        <a class="a2" href="">
                            MALIGNANT DISEASE & IMMUNOSUPPRESSIONS</a>
                        <a clsss="a2" href="">MUSCLE & JOINT</a>


                    </div>


                </li>
                <li class="Medicine">
                    <a class="a1">MEDICAL DEVICES </a>
                    <div class="dropdown-medicine">
                        <a class="a2" href="">FIRST AID</a>
                        <a class="a2" href="">HEALTH DEVICES</a>
                        <a class="a2" href=""> SUPPORTS & BRACES</a>



                    </div>


                </li>
                <li class="Medicine">
                    <a class="a1">WELLNESS</a>
                    <div class="dropdown-medicine">
                        <a class="a2" href="">MOTHER & BABY</a>
                        <a class="a2" href="">COUGH, COLD & ALLERGY</a>
                        <a class="a2" href="">DIET & NUTRITION</a>
                        <a class="a2" href=""> BEAUTY SUPPLEMENTS</a>
                        <a class="a2 " href="">ADULT & DIABETIC CARE</a>
                        <a class="a2" href=""> PREVENTIVE CARE</a>
                        <a class="a2" href="">
                            PAIN & FEVER</a>
                        <a clsss="a2" href="">EYES & EARS</a>




                    </div>


                </li>

                </li>
                <li class="Medicine">
                    <a class="a1">PERSONAL CARE</a>
                    <div class="dropdown-medicine">
                        <a class="a2" href="">NOURISHMENT</a>
                        <a class="a2" href="">ACCESSORIES</a>
                        <a class="a2" href="">SKIN CARE</a>
                        <a class="a2" href=""> HAND & FOOT CARE</a>

                    </div>


                </li>
                <li class="Medicine"> <a class="a1" href="">GNC</a></li>
                <li class="Medicine"> <a class="a1" href="">SWISSE</a></li>


            </ul>


        </nav>


    <h1 id="h1"> Prescription View</h1>
        
    
      <style>
        
      </style>
    </head>
    <body>
    
   
      <nav  class="home">
        <a id="a" href="#">HOME</a>

        <!-- Add more links as needed -->
      </nav>

        <?php
      include 'config.php';
      session_start();

      $query = 'SELECT * FROM prescription_records1';
        $result = mysqli_query($connection,$query);
    
      
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="dashboard">
            <div class="sidebar">
                <ul class="sidebar-patient-list">
                    <li><?php echo $row["prescription_id"] . "<br>"; ?></li>
                    <!-- Add more patients as needed -->
                </ul>
            </div>
        </div>
        <?php
    }
}
?>




        <div class="main-content">
          <div class="patient-name-bar">
            <span id="selected-patient-name">Selected Patient Name</span>
          </div>
    
          <h2   id="hh">Patient Details</h2>
          <table class="prescription-list">
            <!-- Your prescription list content goes here -->
          </table>
    
          <div class="details-container">
            <!-- Details will be displayed here -->
          </div>
        </div>
      </div>
    
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          var patientListItems = document.querySelectorAll('.sidebar-patient-list li');
          var selectedPatientName = document.getElementById('selected-patient-name');
          var detailsContainer = document.querySelector('.details-container');
    
          patientListItems.forEach(function (patientItem) {
            patientItem.addEventListener('click', function () {
              // Remove the 'selected-patient' class from all items
              patientListItems.forEach(function (item) {
                item.classList.remove('selected-patient');
              });
    
              // Add the 'selected-patient' class to the clicked item
              patientItem.classList.add('selected-patient');
    
              // Get the patient ID and name from the data attributes
              var patientId = patientItem.getAttribute('data-patient-id');
              var patientName = patientItem.textContent;
    
              // Update the patient name bar
              selectedPatientName.textContent = patientName;
    
              // Display patient details (replace this with your logic)
              detailsContainer.innerHTML = '<h2>Patient Details</h2>' +
                '<p>Patient ID: ' + patientId + '</p>' +
                '<p>Other details go here.</p>';
                document.addEventListener('DOMContentLoaded', function () {
      // Assume customerId is known or obtained from somewhere
      var customerId = patientItem.getAttribute('data-patient-id');;

      // Fetch patient data from the server
      fetch(`/get_patient.php?customerId=${customerId}`)
        .then(response => response.json())
        .then(data => {
          // Update the dashboard with patient information
          document.getElementById('firstName').textContent = data.first_name;
          document.getElementById('lastName').textContent = data.last_name;
          document.getElementById('telephoneNumber').textContent = data.telephone_number;
          document.getElementById('email').textContent = data.email;
          document.getElementById('streetAddress').textContent = data.street_address;
          document.getElementById('city').textContent = data.city;
        })
        .catch(error => console.error('Error fetching patient data:', error));
    });



            });
          });
        });
// Add this at the end of your existing script
document.addEventListener('DOMContentLoaded', function () {
    var patientListItems = document.querySelectorAll('.sidebar-patient-list li');
    var selectedPatientName = document.getElementById('selected-patient-name');
    var detailsContainer = document.querySelector('.details-container');

    patientListItems.forEach(function (patientItem) {
        patientItem.addEventListener('click', function () {
            // Remove the 'selected-patient' class from all items
            patientListItems.forEach(function (item) {
                item.classList.remove('selected-patient');
            });

            // Add the 'selected-patient' class to the clicked item
            patientItem.classList.add('selected-patient');

            // Get the patient ID and name from the data attributes
            var patientId = patientItem.getAttribute('data-patient-id');
            var patientName = patientItem.textContent;

            // Update the patient name bar
            selectedPatientName.textContent = 'Selected Patient ID: ' + patientId;

            // Display patient details (replace this with your logic)
            detailsContainer.innerHTML = '<h2>Patient Details</h2>' +
                '<p>Patient ID: ' + patientId + '</p>' +
                '<p>Other details go here.</p>';
        });
    });
});





      </script>

<div class="dashboard">
    <div class="patient-info">
      <h2>Patient Information</h2>
      <p><strong>First Name:</strong> <span id="firstName"></span></p>
      <p><strong>Last Name:</strong> <span id="lastName"></span></p>
      <p><strong>Telephone Number:</strong> <span id="telephoneNumber"></span></p>
      <p><strong>Email:</strong> <span id="email"></span></p>
      <p><strong>Street Address:</strong> <span id="streetAddress"></span></p>
      <p><strong>City:</strong> <span id="city"></span></p>
    </div>
  </div>

 


        <footer id="ft" style="background: linear-gradient(180deg, #159895 0%, rgba(21, 152, 149, 0.00) 100%); color: #fff; padding: 20px; text-align: center; transform: rotate(180deg);">
            <div  >
              <h3 style="margin-bottom: 10px;">Contact Us</h3>
              <p>Phone: +94-11-1234567</p>
              <p>Email: contact@example.com</p>
            </div>
            <div style="margin-top: 20px;">
              <p>&copy; 2023 Your Website Name</p>
              <p>Designed with a touch of green</p>
            </div>
          </footer>
          
          
          
        </form>
        </body>
        </html>
