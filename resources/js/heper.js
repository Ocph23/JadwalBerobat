export default class Helper {
   //static apiUrl = "http://127.0.0.1:8000/api";
   static apiUrl = "/api";

   static getResepKode(id){
      var str = "" + 1
      var pad = "000000"
      var ans = pad.substring(0, pad.length - str.length) + str;
      return "RS"+ans;
   }

   static getKode = (id, obj) => {
      var str = "" + id;
      var pad = "000000";
      var ans = pad.substring(0, pad.length - str.length) + str
      switch (obj.toLowerCase()) {
         case 'poli':
            return "PL" + ans;
         case 'obat':
            return "OB" + ans;
         case 'dokter':
            return "DT" + ans;
         case 'pasien':
            return "PS" + ans;
         case 'penyakit':
            return "PK" + ans;
         case 'rekammedik':
            return "RM" + ans;
         case 'pegawai':
            return "PG" + ans;
         default:
            return "";
      }

   }

   
   static getPadNumber = (id) => {
      var str = "" + id;
      var pad = "00";
      return pad.substring(0, pad.length - str.length) + str
   }

}