function confirmDeleteCategory(categoria) {
    if (confirm("¿Quieres eliminar la categoria:  " + categoria+"?")){
      document.forms[1].submit();
    }
 }
