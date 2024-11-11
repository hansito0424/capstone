function fetchDevices() {
    fetch('devices.php')
        .then(response => response.json())
        .then(devices => {
            const deviceGrid = document.getElementById('device-grid');
            deviceGrid.innerHTML = ''; 

            devices.forEach(device => {
                const deviceCard = document.createElement('div');
                deviceCard.className = 'device-card';
                deviceCard.innerHTML = `
                    <span class="device-name">${device.name}</span>
                    <label class="switch">
                        <input type="checkbox" ${device.status === 'on' ? 'checked' : ''} 
                               onchange="toggleDevice(${device.id}, this)">
                        <span class="slider round"></span>
                    </label>
                `;
                deviceGrid.appendChild(deviceCard);
            });
        })
        .catch(error => console.error('Error fetching devices:', error));
}

function addDevice() {
    const deviceName = prompt('Enter new device name:');
    if (deviceName) {
        fetch('devices.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name: deviceName })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                fetchDevices(); // Refresh device list
            }
        })
        .catch(error => console.error('Error adding device:', error));
    }
}

function toggleDevice(deviceId, checkbox) {
    const status = checkbox.checked ? 'on' : 'off';
    fetch('devices.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: deviceId, status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Device is now ' + status);
        } else {
            alert(data.message);
            // Revert the checkbox if the update fails
            checkbox.checked = !checkbox.checked;
        }
    })
    .catch(error => {
        console.error('Error toggling device:', error);
        // Revert the checkbox if the fetch fails
        checkbox.checked = !checkbox.checked;
    });
}

window.onload = fetchDevices;
function controlDevice(deviceId, relayState) {
    fetch('http://192.168.100.33/test/control-relay.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'device_id=' + deviceId + '&relayState=' + relayState
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Optional: show a response message
        location.reload(); // Refresh the page to reflect the updated control state
    });
}
