async function fetchWIBTime() {
    try {
        const response = await fetch('https://worldtimeapi.org/api/timezone/Asia/Jakarta');
        const data = await response.json();

        const currentTimeElement = document.getElementById('current-time');
        currentTimeElement.textContent = ""+new Date(data.datetime).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit'});
    } catch (error) {
        console.error('Error fetching time:', error);
    }
}

// Fetch time every second
setInterval(fetchWIBTime, 1000);

// Initial time fetch
fetchWIBTime();
