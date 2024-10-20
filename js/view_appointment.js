document.addEventListener("DOMContentLoaded", function() {
    fetchAppointments();
});

function fetchAppointments() {
    fetch('fetch_appointments.php')
        .then(response => response.json())
        .then(data => {
            const appointmentsList = document.getElementById('appointments-list');
            appointmentsList.innerHTML = '';

            data.forEach(appointment => {
                const appointmentDiv = document.createElement('div');
                appointmentDiv.classList.add('appointment');

                appointmentDiv.innerHTML = `
                    <p><strong>Patient Name:</strong> ${appointment.patient_name}</p>
                    <p><strong>Email:</strong> ${appointment.email}</p>
                    <p><strong>Department:</strong> ${appointment.department}</p>
                    <p><strong>Phone Number:</strong> ${appointment.phone_number}</p>
                    <p><strong>Date:</strong> ${appointment.date}</p>
                    <p><strong>Time:</strong> ${appointment.time}</p>
                    <p><strong>Description:</strong> ${appointment.description}</p>
                `;

                appointmentsList.appendChild(appointmentDiv);
            });
        })
        .catch(error => console.error('Error fetching appointments:', error));
}
