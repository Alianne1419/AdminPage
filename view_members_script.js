document.addEventListener('DOMContentLoaded', function() {
    function fetchMembers() {
        fetch('view_members.php')
            .then(response => response.json())
            .then(data => {
                // Check if both premium and regular arrays are empty
                if (data.premium.length === 0 && data.regular.length === 0) {
                    // Display "No members found"
                    document.querySelectorAll('.data-placeholder').forEach(placeholder => {
                        placeholder.textContent = 'No members found.';
                    });
                } else {
                    // Update the tables with data
                    updateMembersTable('premium-members-table', data.premium);
                    updateMembersTable('regular-members-table', data.regular);
                }
            })
            .catch(error => {
                console.error('Error fetching members:', error);
                document.querySelectorAll('.data-placeholder').forEach(placeholder => {
                    placeholder.textContent = 'Error loading data.';
                });
            });
    }

    function updateMembersTable(tableId, members) {
        const tableBody = document.getElementById(tableId).querySelector('tbody');
        tableBody.innerHTML = ''; // Clear existing rows

        if (members && members.length > 0) {
            members.forEach(member => {
                const row = tableBody.insertRow();
                Object.values(member).forEach(value => {
                    const cell = row.insertCell();
                    cell.textContent = value;
                });

                if (tableId === 'premium-members-table') {
                    const statusCell = row.insertCell();
                    if (member.status === 'active') {
                        statusCell.textContent = 'Active';
                        statusCell.classList.add('status-active');
                    } else if (member.status === 'expiring') {
                        statusCell.textContent = 'Expiring';
                        statusCell.classList.add('status-expiring');
                    } else {
                        statusCell.textContent = 'Expired';
                        statusCell.classList.add('status-expired');
                    }
                }
            });
        } else {
            const row = tableBody.insertRow();
            const cell = row.insertCell();
            cell.colSpan = (tableId === 'premium-members-table') ? 6 : 4;
            cell.textContent = 'No members found.';
            cell.classList.add('data-placeholder');
        }
    }

    fetchMembers();
});