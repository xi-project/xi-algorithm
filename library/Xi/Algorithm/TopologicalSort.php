<?php
namespace Xi\Algorithm;

/**
 * Implements topological sorting.
 *
 * Topological sorting means sorting the nodes in a directed acyclic graph into a list such
 * that if a node X points to a node Y then Y appears before X in the list.
 * This is useful for things like resolving dependencies.
 *
 * http://en.wikipedia.org/wiki/Topological_sorting
 */
class TopologicalSort
{
    /**
     * @param  array                     $edges An array of scalars to arrays of scalars, representing the edges in the graph.
     * @return array                     An array of nodes in the graph.
     * @throws \InvalidArgumentException if the graph has a cycle or $deps is in an invalid format
     */
    public static function apply(array $edges)
    {
        $allNodes = self::allNodes($edges);

        // We do a depth-first search.
        // A node is marked with 1 when first seen and with 2 when recursion returns from it.
        // If we meet a node marked 0 then we recursively add its descendants to the list before adding it to the list.
        // If we meet a node marked 1 then we've found a cycle, which is an error.
        // If we meet a node marked 2 then it's already on the list and we return.
        $unmarkedNodes = array_fill_keys($allNodes, null);
        $marks = array_fill_keys($allNodes, 0);
        $result = array();

        $visit = function ($node) use ($edges, &$visit, &$marks, &$unmarkedNodes, &$result) {
            $mark = $marks[$node];
            if ($mark === 0) {
                $marks[$node] = 1;
                unset($unmarkedNodes[$node]);

                foreach ((isset($edges[$node]) ? $edges[$node] : array()) as $next) {
                    $visit($next);
                }

                $marks[$node] = 2;
                $result[] = $node;
            } elseif ($mark === 1) {
                throw new \InvalidArgumentException("The graph has a cycle involving node $node");
            }
        };

        // We try each node as a starting point since we don't know which node (if any) is the root node.
        // (if the graph has unconnected subgraphs then their order in the list is undefined).
        while (!empty($unmarkedNodes)) {
            $node = key($unmarkedNodes);
            unset($unmarkedNodes[$node]);
            $visit($node);
        }

        return $result;
    }

    private static function allNodes(array $deps)
    {
        $allNodes = array();
        foreach ($deps as $node => $others) {
            if (!is_array($others)) {
                throw new \InvalidArgumentException('Dependencies should be given as arrays, not single elements.');
            }
            $allNodes[] = $node;
            foreach ($others as $other) {
                $allNodes[] = $other;
            }
        }

        return array_unique($allNodes);
    }
}
