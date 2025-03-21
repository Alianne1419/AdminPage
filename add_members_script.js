document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addMemberForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);
        const joinDate = new Date(formData.get('join_date'));
        const membershipType = formData.get('membership_type');
        let expiryDate;

        if (membershipType === 'Premium') {
            expiryDate = new Date(joinDate);
            expiryDate.setMonth(expiryDate.getMonth() + 1); // Add 1 month
        } else {
            expiryDate = null; // Regular members don't have expiry
        }

        formData.append('expiry_date', expiryDate ? expiryDate.toISOString().split('T')[0] : '');

        fetch('add_member_process.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Member added successfully!');
                form.reset();
                // Optionally redirect to view members or dashboard
            } else {
                alert('Error adding member: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding the member.');
        });
    });
});

