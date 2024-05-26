import Dokter from "./Dokter";

class  Obat  {
    id:number;
    kode: String;
    nama: String;
    keterangan:String;
    dokter:Dokter;
    dokter_id:number;
}

export default Obat;