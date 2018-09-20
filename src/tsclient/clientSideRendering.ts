import * as $ from "jquery";
import {twig} from "twig";
/**
 * The client side rendering class
 */
export class ClientSideRendering {
    public static MAX_TPL_DEEP = 99;
    /**
     * Will reshow the twig previously hidden
     * @param {string} str
     * @return string
     */
    public static showTwigIn(str: string): string {
        return str
            .split("²==//") . join ( "}")
            .split("==²//") . join ( "{");
    }

    /**
     * Will render a template using its data-id, will append or replace using the given id.
     * @param {string} templateDataId
     * @param {object} states
     */
    public static render(templateDataId: string, states: any): void {
        window["csr"] = this;
        // if this template id is already in memory
        if (typeof (window["templates"][templateDataId]) !== "undefined") {
            console.log(this.TemplateNameToId(templateDataId));
            console.log(this.TemplateNameToId(templateDataId, true));
            const baseTpl: any =  window["baseTemplates"].find((e) => {
                return e.generatedID === this.TemplateNameToId(templateDataId, true);
            });
            // we re-render it using twig.js and jquery
            const template: any = twig({
                data: baseTpl.twig
            });
            console.log(baseTpl);
            const selectedElement = $("[data-id=\"" + templateDataId + "\"]");
            console.log("length : ( 1 ) : " + selectedElement.length + " states : " + Object.keys(states).length + " data : " +
                baseTpl.twig.length);
            selectedElement[0].outerHTML = template.render(states);
        }
        // else, we try to append this template
        else {
            const nonDigit: string = this.TemplateNameToId(templateDataId, true);
            let maxId: number = 0;
            for (let tpl in window["templates"]) {
                if (window["templates"].hasOwnProperty(tpl)) {
                    if (tpl.substr(0, tpl.length - (tpl.length - nonDigit.length)) === nonDigit) {
                        maxId++;
                    }
                }
            }
            if (maxId > 0) {
                // append here
                const template = twig({
                    data: window["baseTemplates"].find((e) => {
                        return e.generatedID === this.TemplateNameToId(templateDataId, true);
                    }).twig
                });
                let output: any = template.render(states);
                const selectedElement = $("[data-id=\"" + this.getMaxType(templateDataId) + "\"]");
                selectedElement.after(output);
                console.log("length : ( 1 ) : " + selectedElement.length);

            }
        }
        return;
    }

    /**
     * Convert id to type
     * @param {string} id
     * @returns {string}
     * @constructor
     */
    public static TemplateNameToId(id: string, idOnly: boolean = false): string {
        const generatedID: string = id.replace(/[0-9]/g, "") + "0";
        if (idOnly) {
            return generatedID;
        }
        const foundIndex = window["baseTemplates"].findIndex(function(element) {
            return element.generatedID === generatedID;
        });
        return foundIndex;
    }

    /**
     * Will generate a new type id using a template id/type
     * @param {string} type
     * @param {number} minus
     * @returns {string}
     */
    public static getMaxType(type: string): string {
        const nonDigit: string = this.TemplateNameToId(type, true);
        let maxId: number = 0;
        for (let tpl in window["templates"]) {
            if (window["templates"].hasOwnProperty(tpl)) {
                if (tpl.substr(0, tpl.length - (tpl.length - nonDigit.length)) === nonDigit) {
                    let digit: number = parseInt(tpl.replace(/\D/g, ""));
                    maxId = digit > maxId ? digit : maxId;
                }
            }
        }
        return nonDigit + maxId.toString();
    }

    /**
     * Will render recursivly the given templates states object without
     * @param {object} states
     * @param {number} deep
     * @param {object} renderedArray
     * @constructor
     */
    public static RenderStates(states: object, deep: number = 0, renderedArray: object = []): void {
        // TODO : remove non anwsered html elements
        // TODO : set window['templates'] values accordely
        if  (deep > ClientSideRendering.MAX_TPL_DEEP) {
            return;
        } else {
            for (let tplKey in states) {
                if  (typeof (states[tplKey]["states"] !== "undefined")                  &&
                    (states[tplKey]["states"]["references"] !== "undefined")            &&
                    ((Object.keys(states[tplKey]["states"]["references"])).length > 0))  {
                    for (let referenceKey in states[tplKey]["states"]["references"]) {
                        if (typeof renderedArray[states[tplKey]["states"]["references"][referenceKey]] === "undefined") {
                            renderedArray[states[tplKey]["states"]["references"][referenceKey]] = "BONJOUR";
                            let statesArray: object = {};
                            statesArray[states[tplKey]["states"]["references"][referenceKey]] = {
                                states: states[states[tplKey]["states"]["references"][referenceKey]]
                            };
                            // TODO : Add if not loaded array here
                            ClientSideRendering.RenderStates (
                                statesArray,
                                ++deep,
                                renderedArray
                            );
                        }
                    }
                    ClientSideRendering.render(tplKey, states[tplKey]["states"]);
                    return;
                }
            }
        }
    }
}