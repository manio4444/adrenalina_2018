tinymce.init({
  selector: "#tinymce",
  language: "pl",
  plugins : "advlist autolink autoresize link image lists charmap preview table responsivefilemanager hr code",
  toolbar1: "undo, redo | bold, italic, underline, strikethrough | alignleft, aligncenter, alignright, alignjustify | bullist, numlist, hr |  table | outdent, indent | blockquote, subscript, superscript | styleselect, removeformat | link, image, responsivefilemanager | print preview code",
  menubar: false,
  content_css: "imgcss/main.css",
  autoresize_max_height: "800",




  external_filemanager_path:"/filemanager/",
  filemanager_title:"Responsive Filemanager" ,
  external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
});
