import {jsonTree} from "./JsonTree";
const $: JQueryStatic = window["$"];
export class JsonViewer {
    public static refresh() {
        $(".jsonEncoded").each(
            (i: number) => {
                const selector = $(".jsonEncoded");
                try {
                    let parsedJson = JSON.parse(selector[i].innerHTML);
                    selector[i].innerHTML = "";
                    jsonTree.create(parsedJson, selector[i]);
                } catch (e) {
                    console.log("Invalid json provided");
                    console.log(e);
                }
        });
    }
}
window["jsonview"] = JsonViewer;


