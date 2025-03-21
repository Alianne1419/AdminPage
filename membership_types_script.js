document.addEventListener('DOMContentLoaded', function() {
    const membershipList = document.getElementById('membershipList');
    const addForm = document.getElementById('addMembershipForm');

    function loadMembershipTypes() {
        fetch('get_membership_types.php')
            .then(response => response.json())
            .then(data => {
                membershipList.innerHTML = '';
                data.forEach(type => {
                    const item = document.createElement('div');
                    item.classList.add('membership-type-item');
                    item.innerHTML = `
                        <span>${type.type_name} - ₱${type.amount} (${type.duration} months)</span>
                        <div class="actions">
                            <button onclick="editMembership(${type.type_id})">Edit</button>
                            <button onclick="deleteMembership(${type.type_id})">Delete</button>
                        </div>
                    `;
                    membershipList.appendChild(item);
                });
            });
    }

    loadMembershipTypes();

    addForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(addForm);

        fetch('add_membership_type.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Membership type added successfully!');
                addForm.reset();
                loadMembershipTypes();
            } else {
                alert('Error adding membership type: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred.');
        });
    });

    window.editMembership = function(typeId) {
        // Implement edit logic here (fetch data, show edit form, etc.)
        alert(`Edit membership type with ID: ${typeId}`);
    };

    window.deleteMembership = function(typeId) {
        fetch(`delete_membership_type.php?type_id=${typeId}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Membership type deleted successfully!');
                loadMembershipTypes();
            } else {
                alert('Error deleting membership type: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred.');
        });
    };
});

