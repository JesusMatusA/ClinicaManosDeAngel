let btnSeePatient = document.getElementById("btnSeePatient");
let btnSeeDates = document.getElementById("btnSeeDates");
let btnLogOut = document.getElementById("btnLogout");

btnSeePatient.addEventListener(
    "click",
    () => (location.href = "../doctorScreens/SeePatientScreen.php")
);

btnSeeDates.addEventListener(
    "click",
    () => (location.href = "../doctorScreens/SeeCurrentDatesScreen.php")
);

btnLogOut.addEventListener("click", () => (location.href = "../../logout.php"));
