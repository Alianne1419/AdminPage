function updateDashboardData(data) {
    if (!data) {
        console.error("No data provided to updateDashboardData.");
        return;
    }

    let loadingTimeout = setTimeout(() => {
        console.error("Dashboard data loading timed out.");
        // Replace "Loading..." with an error message
        document.querySelectorAll('.data-placeholder').forEach(placeholder => {
            placeholder.innerHTML = "Error loading data.";
        });
    }, 10000); // 10 seconds timeout

    try {
        // Update cards
        if (data.cards) {
            document.querySelector('.card:nth-child(1) p').textContent = data.cards.totalMembers || "";
            document.querySelector('.card:nth-child(2) p').textContent = data.cards.membershipTypes || "";
            document.querySelector('.card:nth-child(3) p').textContent = data.cards.expiringSoon || "";
            document.querySelector('.card:nth-child(4) p').textContent = data.cards.totalRevenue || "";
            document.querySelector('.card:nth-child(5) p').textContent = data.cards.newMembers || "";
            document.querySelector('.card:nth-child(6) p').textContent = data.cards.expiredMemberships || "";
        }

        // Update recent members table
        if (data.recentMembers && Array.isArray(data.recentMembers)) {
            const tableBody = document.querySelector('#recent-members-table tbody');
            tableBody.innerHTML = ''; // Clear existing rows

            if (data.recentMembers.length > 0) {
                data.recentMembers.forEach(member => {
                    const row = tableBody.insertRow();
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);
                    cell1.textContent = member.name || "";
                    cell2.textContent = member.joinDate || "";
                    cell3.textContent = member.membershipType || "";
                });
            } else {
                const row = tableBody.insertRow();
                const cell = row.insertCell(0);
                cell.colSpan = 3;
                cell.textContent = "No recent members.";
                cell.classList.add('data-placeholder');
            }
        } else {
            console.error("Invalid recent members data.");
            document.querySelector('#recent-members-table tbody').innerHTML = '<tr><td colspan="3" class="data-placeholder">Error loading data.</td></tr>';

        }

        clearTimeout(loadingTimeout);

    } catch (error) {
        console.error("Error updating dashboard:", error);
        clearTimeout(loadingTimeout);
    }
}