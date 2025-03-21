document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editMemberForm');
    const fetchButton = document.getElementById('fetchMember');

    fetchButton.addEventListener('click', function() {
        const memberId = document.getElementById('member_id').value;
        if (memberId) {
            fetch(`get_member_info.php?member_id=${memberId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('name').value = data.member.name;
                        document.getElementById('email').value = data.member.email;
                        document.getElementById('phone').value = data.member.phone || '';
                        document.getElementById('address').value = data.member.address || '';
                    } else {
                        alert('Member not found.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
        }
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('update_member_process.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Member updated successfully!');
            } else {
                alert('Error updating member: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the member.');
        });
    });
});

