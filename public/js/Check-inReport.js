// ===== Helper =====
const $  = (s, p = document) => p.querySelector(s);
const $$ = (s, p = document) => Array.from(p.querySelectorAll(s));
function ymd(d)        { return new Date(d).toISOString().slice(0, 10); }
function fmtTime(iso)  { const d = new Date(iso); return d.toLocaleString([], { hour: '2-digit', minute: '2-digit' }); }

// facility key -> label แสดงผล
const FAC = {
  badminton_outdoor: 'แบดมินตันกลางแจ้ง',
  badminton_dome:    'แบดมินตันในโดม',
  tennis:            'เทนนิส',
  basketball:        'บาสเก็ตบอล',
  pool:              'สระว่ายน้ำ',
  petanque:          'เปตอง',
  futsal:            'ฟุตซอล',
  track:             'ลู่-ลาน',
  volleyball:        'วอลเลย์บอล',
  sepak_takraw:      'เซปักตะกร้อ'
};

// ===== Global State =====
let allRows = [];        // ข้อมูลทั้งหมดจาก API
let filtered = [];       // ข้อมูลหลังกรอง (ใช้แสดง/นับ/วาดกราฟ)
let facilityFilter = 'all'; // all | outdoor | badminton | pool | track
let BAR = null;          // Chart.js instance (กราฟแท่ง)

// map facility รายละเอียด -> หมวดหลักของ chips
function catOf(fac) {
  if (fac === 'pool') return 'pool';
  if (fac === 'track') return 'track';
  if (fac && fac.startsWith('badminton_')) return 'badminton';
  // ที่เหลือถือเป็น "กลางแจ้ง"
  return 'outdoor';
}

// ไล่วันในช่วง (คืนค่า array ของ 'YYYY-MM-DD')
function enumerateDays(from, to) {
  const arr = [];
  if (!from || !to) return arr;
  let d = new Date(from);
  const end = new Date(to);
  while (d <= end) {
    arr.push(d.toISOString().slice(0, 10));
    d.setDate(d.getDate() + 1);
  }
  return arr;
}

function labelFromKey(key){
  switch (key) {
    case 'outdoor':   return 'สนามกลางแจ้ง';
    case 'badminton': return 'แบดมินตัน';
    case 'pool':      return 'สระว่ายน้ำ';
    case 'track':     return 'ลู่-ลาน';
    default:          return 'ทั้งหมด';
  }
}

// ===== รับช่วงวันที่จาก ?session= และตั้งค่าจาก input =====
const url   = new URL(location.href);
const sess  = url.searchParams.get('session');
const $from = $('#from'), $to = $('#to');
if (sess) { $from.value = sess; $to.value = sess; }
else {
  const today = ymd(new Date());
  $from.value = today; $to.value = today;
}

// ===== Fetch ข้อมูลจาก API (โปรดตรวจเส้นทางให้ตรงแบ็กเอนด์) =====
async function fetchCheckins(params) {
  const qs  = new URLSearchParams(params).toString();
  const res = await fetch('/api/checkins?' + qs);
  return res.ok ? res.json() : [];
}

// ===== Main flow =====
async function load() {
  const from     = $from.value || ymd(new Date());
  const to       = $to.value   || ymd(new Date());
  const facility = (facilityFilter === 'all') ? '' : facilityFilter; // ให้ API รับคีย์หมวด (ถ้าต้องใช้ราย facility จริง ปรับฝั่ง API)

  // 1) ดึงข้อมูล
  allRows = await fetchCheckins({ from, to, facility });

  // 2) กรอง & แสดงผล
  applyFilters();
}

function applyFilters() {
  const q = ($('#q')?.value || '').trim().toLowerCase();

  filtered = allRows.filter(r => {
    const cat = catOf(r.facility);                                 // หมวดของแถวนี้
    const okFac = (facilityFilter === 'all') || (cat === facilityFilter);
    const bag = (FAC[r.facility] || r.facility || '').toLowerCase(); // ชื่อสนามเพื่อค้นหา
    return okFac && (!q || bag.includes(q));
  });

  render();
}

function render() {
  // ---------- ตาราง ----------
  const tb = $('#table tbody');
  if (tb) {
    tb.innerHTML = '';
    filtered.forEach(r => {
      const tr = document.createElement('tr');
      tr.innerHTML =
        `<td>${fmtTime(r.ts)}</td>` +
        `<td>${r.session_date}</td>` +
        `<td>${FAC[r.facility] || r.facility}</td>` +
        `<td></td><td></td><td></td><td></td>`; // ไม่มี PII
      tb.appendChild(tr);
    });
  }

  // ---------- สถิติ (ตัวเลขการ์ด) ----------
  const total     = filtered.length;
  const outdoor   = filtered.filter(r => catOf(r.facility)==='outdoor').length;
  const badminton = filtered.filter(r => catOf(r.facility)==='badminton').length;
  const pool      = filtered.filter(r => catOf(r.facility)==='pool').length;
  const track     = filtered.filter(r => catOf(r.facility)==='track').length;

  if ($('#st-total'))      $('#st-total').textContent      = String(total);
  if ($('#st-outdoor'))    $('#st-outdoor').textContent    = String(outdoor);
  if ($('#st-badminton'))  $('#st-badminton').textContent  = String(badminton);
  if ($('#st-pool'))       $('#st-pool').textContent       = String(pool);
  if ($('#st-track'))      $('#st-track').textContent      = String(track);

  // ---------- กราฟแท่งรายวัน ----------
  const from = $from.value, to = $to.value;
  const days   = enumerateDays(from, to);
  const counts = days.map(d => filtered.filter(r => r.session_date === d).length);
  renderBar(days, counts, facilityFilter);
}

// วาดกราฟแท่ง (Chart.js)
function renderBar(labels, data, facKey) {
  const canvas = document.getElementById('usageBar');
  if (!canvas) return;

  if (BAR) BAR.destroy();
  BAR = new Chart(canvas, {
    type: 'bar',
    data: {
      labels,
      datasets: [{
        label: labelFromKey(facKey) + ' (รายการ/วัน)',
        data,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: { y: { beginAtZero: true, precision: 0 } },
      plugins: { tooltip: { mode: 'index', intersect: false } }
    }
  });
}

// ===== Export: สรุปเป็น "วันที่ / ชื่อสนาม / จำนวนคนเข้าใช้" =====
function rowsForExport() {
  const map = new Map(); // key = date|facility
  filtered.forEach(r => {
    const key = `${r.session_date}|${r.facility}`;
    map.set(key, (map.get(key) || 0) + 1);
  });
  const rows = [];
  for (const [k, count] of map.entries()) {
    const [date, fac] = k.split('|');
    rows.push({ 'วันที่ (session)': date, 'ชื่อสนาม': (FAC[fac] || fac), 'จำนวนคนเข้าใช้': count });
  }
  rows.sort((a, b) =>
    a['วันที่ (session)'].localeCompare(b['วันที่ (session)']) ||
    a['ชื่อสนาม'].localeCompare(b['ชื่อสนาม'])
  );
  return rows;
}

// ปุ่ม export (ต้องมีสคริปต์ XLSX/jsPDF/docx รวมในหน้า Blade แล้ว)
$('#btnExcel')?.addEventListener('click', () => {
  const ws = XLSX.utils.json_to_sheet(rowsForExport());
  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, 'Counts');
  XLSX.writeFile(wb, `checkins_${$from.value || ''}_${$to.value || ''}.xlsx`);
});

$('#btnPDF')?.addEventListener('click', () => {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ orientation: 'p', unit: 'pt', format: 'a4' });
  const data = rowsForExport();
  doc.setFont('Helvetica', ''); doc.setFontSize(12);
  doc.text(`รายงานผู้เข้าใช้สนามกีฬา (ช่วง ${$from.value || ''} - ${$to.value || ''})`, 40, 40);
  const headers = [['วันที่ (session)', 'ชื่อสนาม', 'จำนวนคนเข้าใช้']];
  const body = data.map(o => [o['วันที่ (session)'], o['ชื่อสนาม'], o['จำนวนคนเข้าใช้']]);
  doc.autoTable({ head: headers, body, startY: 60, styles: { fontSize: 10 } });
  doc.save(`checkins_${$from.value || ''}_${$to.value || ''}.pdf`);
});

$('#btnDoc')?.addEventListener('click', async () => {
  const { Document, Packer, Paragraph, Table, TableRow, TableCell, WidthType, HeadingLevel, AlignmentType } = docx;
  const rows = rowsForExport();
  const headerCells = ['วันที่ (session)', 'ชื่อสนาม', 'จำนวนคนเข้าใช้']
    .map(t => new TableCell({ children: [new Paragraph({ text: t, bold: true })] }));
  const tableRows = [new TableRow({ children: headerCells })];
  rows.forEach(r => {
    tableRows.push(new TableRow({
      children: [r['วันที่ (session)'], r['ชื่อสนาม'], r['จำนวนคนเข้าใช้']]
        .map(v => new TableCell({ children: [new Paragraph(String(v))] }))
    }));
  });
  const table = new Table({ width: { size: 100, type: WidthType.PERCENT }, rows: tableRows });
  const docu = new Document({
    sections: [{
      children: [
        new Paragraph({ text: 'รายงานผู้เข้าใช้สนามกีฬา', heading: HeadingLevel.HEADING_1, alignment: AlignmentType.CENTER }),
        new Paragraph(`ช่วง ${$from.value || ''} - ${$to.value || ''}`),
        table
      ]
    }]
  });
  const blob = await Packer.toBlob(docu);
  const a = document.createElement('a'); a.href = URL.createObjectURL(blob);
  a.download = `checkins_${$from.value || ''}_${$to.value || ''}.docx`; a.click();
});

$('#btnPrint')?.addEventListener('click', () => window.print());

// ===== Events =====
$('#q')?.addEventListener('input', () => { clearTimeout(window._q); window._q = setTimeout(applyFilters, 250); });

$$('#chips .chip').forEach(ch => ch.addEventListener('click', () => {
  $$('#chips .chip').forEach(x => x.classList.remove('selected'));
  ch.classList.add('selected');
  facilityFilter = ch.dataset.k; // all | outdoor | badminton | pool | track
  load();
}));

// เริ่มต้น
load();
