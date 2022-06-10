let btnAddScreen = document.getElementById("btnAddProductScreen");
let btnSeeScreen = document.getElementById("btnSeeProductScreen");

btnAddScreen.addEventListener(
    "click",
    () => (location.href = "../storageScreens/addProductScreen.php")
);
btnSeeScreen.addEventListener(
    "click",
    () => (location.href = "../storageScreens/SeeProductScreen.php")
);
