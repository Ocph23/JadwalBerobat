export default class Helper {
   static apiUrl = "http://127.0.0.1:8000/api";


   static getKode = (id, obj) => {
      var str = "" + 1
      var pad = "000000"
      var ans = pad.substring(0, pad.length - str.length) + str
      switch (obj.name) {
         case 'Poli':
            return "PL" + ans;
         case 'Obat':
            return "OB" + ans;
         case 'Dokter':
            return "DT" + ans;
         case 'Pasien':
            return "PS" + ans;
         case 'Penyakit':
            return "PK" + ans;
         case 'RekamMedik':
            return "RM" + ans;
         case 'Pegawai':
            return "PG" + ans;
         default:
            return "";
      }

   }

}