function addForm() {
    document.getElementById("addForm").style.display = "grid";
    document.getElementById("modal-backbround").style.display = "block";
  }
  
  function deleteForm() {
    document.getElementById("deleteForm").style.display = "grid";
    document.getElementById("modal-backbround").style.display = "block";
  }
  
  function closeFormAdd() {
    document.getElementById("addForm").style.display = "none";
    document.getElementById("modal-backbround").style.display = "none";
  }
  
  function closeFormDelete() {
    document.getElementById("deleteForm").style.display = "none";
    document.getElementById("modal-backbround").style.display = "none";
  }