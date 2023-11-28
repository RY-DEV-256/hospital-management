<div class="form-group my-2">
  <label for="specialization" class="form-label">Select Specialization</label>
  <select name="specialization" id="specialization" class="form-control">
    <?php
    $specialization = $connection->query("SELECT DISTINCT specialization FROM doctors");
    while ($row = $specialization->fetch_assoc()) {
    ?>
      <option value="<?= $row['specialization']; ?>"><?= $row['specialization']; ?></option>

    <?php
    }
    ?>
  </select>
</div>
<script>
        // Get references to the select inputs
        const specializationSelect = document.getElementById('specialization');
        const doctorSelect = document.getElementById('doctor');

        // Add an event listener to the specialization select input
        specializationSelect.addEventListener('change', () => {
            // Get the selected specialization
            const selectedSpecialization = specializationSelect.value;

            // Make an AJAX request to get the doctors with the selected specialization
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Parse the response as JSON
                        const doctors = JSON.parse(xhr.responseText);

                        // Clear the options in the doctor select input
                        doctorSelect.innerHTML = '';

                        // Loop through each doctor and create an option in the select input
                        doctors.forEach(doctor => {
                            const option = document.createElement('option');
                            option.value = doctor.id;
                            option.textContent = doctor.name;
                            doctorSelect.appendChild(option);
                        });
                    } else {
                        console.error('Error getting doctors:', xhr.status);
                    }
                }
            };
            xhr.open('POST', `get_doctors.php?specialization=${selectedSpecialization}`);
            xhr.send();
        });
    </script>
<?php
include("../parts/db-con.php");

// Get the selected specialization from the query string
$selectedSpecialization = $_GET['specialization'];

// Query the database for doctors with the selected specialization
$doctors = $connection->query("SELECT * FROM doctors WHERE specialization = '$selectedSpecialization'");

// Create an array to hold the results
$results = [];

// Loop through each doctor and add their information to the results array
while ($row = $doctors->fetch_assoc()) {
  $results[] = [
    'id' => $row['doctor_id'],
    'name' => $row['first_name']
  ];
}

// Return the results as JSON
header('Content-Type: application/json');
echo json_encode($results);
