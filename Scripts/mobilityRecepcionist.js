let btnAddDate = document.getElementById("btnAddDateScreen");
let btnSeeDate = document.getElementById("btnSeeDateScreen");
let btnAddClient = document.getElementById("btnAddClientScreen");
let btnSeeClient = document.getElementById("btnSeeClientScreen");
let btnLogOut = document.getElementById("btnLogout");

btnSeeDate.addEventListener(
    "click",
    () => (location.href = "../recepcionistScreens/SeeDateScreen.php")
);
btnAddClient.addEventListener(
    "click",
    () => (location.href = "../recepcionistScreens/AddClientScreen.php")
);
btnSeeClient.addEventListener(
    "click",
    () => (location.href = "../recepcionistScreens/SeeClientScreen.php")
);
btnLogOut.addEventListener("click", () => (location.href = "../../logout.php"));
