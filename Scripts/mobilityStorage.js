let btnAddScreen = document.getElementById("btnAddProductScreen");
let btnSeeScreen = document.getElementById("btnSeeProductScreen");
let btnLogOut = document.getElementById("btnLogout");

btnAddScreen.addEventListener(
    "click",
    () => (location.href = "../storageScreens/addProductScreen.php")
);
btnSeeScreen.addEventListener(
    "click",
    () => (location.href = "../storageScreens/SeeProductScreen.php")
);

btnLogOut.addEventListener("click", () => (location.href = "../../logout.php"));
