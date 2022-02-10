
function convertTwoDigits(number) {
    if (number < 10) {
        number = "0" + number;
    }
    return number;
}

function clock () {
    let now = new Date();
    let year = now.getFullYear();
    let month = convertTwoDigits(now.getMonth() + 1);
    let day = convertTwoDigits(now.getDate());
    let hour = convertTwoDigits(now.getHours());
    let minutes = convertTwoDigits(now.getMinutes());
    let seconds = convertTwoDigits(now.getSeconds());

    document.getElementById("clock_date").textContent = year + "年" + month + "月" + day + "日";
    document.getElementById("clock_time").textContent = hour + ":" + minutes + ":" + seconds ;
}

setInterval(clock, 1000);
