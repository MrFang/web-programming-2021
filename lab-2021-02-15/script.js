const fileType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
// Desired file extesion
const fileExtension = '.xlsx';

const exportToSpreadsheet = (data, fileName) => {
  //Create a new Work Sheet using the data stored in an Array of Arrays.
  const workSheet = XLSX.utils.aoa_to_sheet(data);
  // Generate a Work Book containing the above sheet.
  const workBook = {
    Sheets: { data: workSheet, cols: [] },
    SheetNames: ["data"],
  };
  // Exporting the file with the desired name and extension.
  const excelBuffer = XLSX.write(workBook, { bookType: "xlsx", type: "array" });
  const fileData = new Blob([excelBuffer], { type: fileType });
  saveAs(fileData, fileName + fileExtension);
};


$('#export-button').on('click', () => {
  fetch(`${window.location.origin}/PSTGU/2019/zolotukhin/2021/lab-2021-02-15/api.php`)
    .then(resp => resp.json())
    .then(json => exportToSpreadsheet(json.data))
})