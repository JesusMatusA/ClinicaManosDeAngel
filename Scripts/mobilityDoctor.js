let btnSeePatient = document.getElementById("btnSeePatient");
let btnSeeDates = document.getElementById("btnSeeDates");

btnSeePatient.addEventListener(
    "click",
    () => (location.href = "../doctorScreens/SeePatientScreen.php")
);

btnSeeDates.addEventListener(
    "click",
    () => (location.href = "../doctorScreens/SeeCurrentDatesScreen.php")
);
