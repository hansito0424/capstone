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
        });
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
            if (data.success) {
                alert(data.message);
                fetchDevices();
            } else {
                alert(data.message);
            }
        });
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
        if (!data.success) {
            alert(data.message);
            alert('device is now ' + status);
        }
    });
}
function toggleDevice(checkbox) {
    let status = checkbox.checked ? 'on' : 'off';
    alert('device is now ' + status);
}

window.onload = fetchDevices;
