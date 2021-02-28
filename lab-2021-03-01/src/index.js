import { exportToSpreadsheet } from './exportToXLSX'
import { exportToPDF } from './exportToPDF'

$('#export-xlsx-button').on('click', () => {
  fetch('http://students.yss.su/PSTGU/2019/zolotukhin/2021/lab-2021-02-15/api.php')
    .then(resp => resp.json())
    .then(json => exportToSpreadsheet(json.data))
})

$('#export-pdf-button').on('click', () => {
  fetch('http://students.yss.su/PSTGU/2019/zolotukhin/2021/lab-2021-02-15/api.php')
    .then(resp => resp.json())
    .then(json => exportToPDF(json.data))
})
