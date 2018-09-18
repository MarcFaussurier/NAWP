import * as io from "socket.io-client";
import {ClientSideRendering} from "./clientSideRendering";

export class SocketClient {
    /*
     * Instance of current socket
     */
    public socket;

    /**
     * The SocketClient constructor
     */
    public constructor() {
        this.socket = io("http://127.0.0.1:8070");
        this.socket.on("packetout", function(data) {
            window["csr"] = ClientSideRendering;
            console.log("got packet : ");
            console.log(data);
            if (data instanceof Object) {
                for (let key in data) {
                    if (data.hasOwnProperty(key)) {
                        ClientSideRendering.render(key, data[key]["states"]);
                    }
                }
            }
        });
        console.log("socket built");
    }
}