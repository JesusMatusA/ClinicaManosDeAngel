let btnAddScreen = document.getElementById("btnAddProductScreen");
let btnOutputScreen = document.getElementById("btnOutputProductScreen");
let btnSeeScreen = document.getElementById("btnSeeProductScreen");
let btnModifyScreen = document.getElementById("btnModifyProductScreen");
let btnDeletesScreen = document.getElementById("btnDeleteProductScreen");

btnAddScreen.addEventListener(
    "click",
    () => (location.href = "../storageScreens/addProductScreen.php")
);
btnOutputScreen.addEventListener(
    "click",
    () => (location.href = "../storageScreens/outputProductScreen.php")
);
btnSeeScreen.addEventListener(
    "click",
    () => (location.href = "../storageScreens/firstScreen.php")
);
btnModifyScreen.addEventListener(
    "click",
    () => (location.href = "../storageScreens/modifyProductScreen.php")
);
btnDeletesScreen.addEventListener(
    "click",
    () => (location.href = "../storageScreens/deleteProductScreen.php")
);
