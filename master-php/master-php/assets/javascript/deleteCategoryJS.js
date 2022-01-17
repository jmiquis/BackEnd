function deleteCategoryJS(name,id) {
    if(confirm("¿Desea eliminar la categoria "+name+" ?")){
        document.getElementById(id).submit();
}
}